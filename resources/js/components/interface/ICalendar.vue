<template>
  <v-calendar
    :now="now"
    :value="value"
    :events="eventProxies"
    :type="type"
    :first-time="firstTime"
    :interval-count="intervals"
    :weekdays="weekDays"
    locale="es"
    @mousedown:event="startDrag"
    @mousedown:time="startTime"
    @mousemove:time="mouseMove"
    @mouseup:time="endDrag"
    @mouseleave.native="cancelDrag"
  >
    <template v-slot:event="{ event, timed, eventSummary }">
      <i-grid class="pa-0">
        <i-grid-row>
          <i-grid-column cols="9">
            <div class="v-event-draggable" v-html="eventSummary()" />
          </i-grid-column>
          <i-grid-column cols="1">
            <i-button-icon size="tiny" value="close" @click="deleteEvent(event)" />
          </i-grid-column>
        </i-grid-row>
        <i-grid-row>
          <i-grid-column>
            <div
              v-if="timed"
              class="v-event-drag-bottom"
              @mousedown.stop="extendBottom(event)"
          /></i-grid-column>
        </i-grid-row>
      </i-grid>
    </template>
  </v-calendar>
</template>
<script>
import { cloneDeep } from "lodash";
import { DateFunctions } from "../../dates";
export default {
  props: {
    value: {
      type: String,
      default: () => DateFunctions.currentDateStr(),
    },
    type: {
      type: String,
      validator: (v) => ["week"].includes(v),
    },
    events: {
      type: Array,
    },
  },
  data: () => ({
    eventColor: "#2196F3",
    firstTime: "0:00",
    intervals: 24,
    now: DateFunctions.currentDateTimeStr(),
    weekDays: [0, 1, 2, 3, 4, 5, 6],
    dragEvent: null,
    dragStart: null,
    createEvent: null,
    createStart: null,
    extendOriginal: null,
    eventProxies: [],
  }),
  created() {
    this.initProxies();
  },
  methods: {
    initProxies() {
      this.eventProxies = cloneDeep(this.events).map((e) => ({
        ...e,
        start: DateFunctions.fromISOToDateTimeStr(e.start),
        end: DateFunctions.fromISOToDateTimeStr(e.end),
      }));
    },
    startDrag({ event, timed }) {
      if (event && timed) {
        this.dragEvent = event;
        this.dragTime = null;
        this.extendOriginal = null;
      }
    },
    startTime(tms) {
      const mouse = this.toTime(tms);
      if (this.dragEvent && this.dragTime === null) {
        const start = DateFunctions.fromStrToMillis(this.dragEvent.start);
        this.dragTime = mouse - start;
      } else {
        this.createStart = this.roundTime(mouse);
        this.createEvent = {
          name: "Disponible",
          color: this.eventColor,
          start: DateFunctions.fromMillisToDateTimeStr(this.createStart),
          end: DateFunctions.fromMillisToDateTimeStr(this.createStart + 1000 * 60 * 60),
          timed: true,
        };
        this.eventProxies.push(this.createEvent);
        this.emit();
      }
    },
    emit() {
      this.$emit("input", this.eventProxies);
    },
    extendBottom(event) {
      this.createEvent = event;
      this.createStart = DateFunctions.fromStrToMillis(event.start);
      this.extendOriginal = DateFunctions.fromStrToMillis(event.end);
    },
    mouseMove(tms) {
      const mouse = this.toTime(tms);

      if (this.dragEvent && this.dragTime !== null) {
        const start = DateFunctions.fromStrToMillis(this.dragEvent.start);
        const end = DateFunctions.fromStrToMillis(this.dragEvent.end);                

        const duration = end - start;
        const newStartTime = mouse - this.dragTime;
        const newStart = this.roundTime(newStartTime);
        const newEnd = newStart + duration;
        
        this.dragEvent.start = DateFunctions.fromMillisToDateTimeStr(newStart);
        this.dragEvent.end = DateFunctions.fromMillisToDateTimeStr(newEnd);
      } else if (this.createEvent && this.createStart !== null) {
        const mouseRounded = this.roundTime(mouse, false);
        const min = Math.min(mouseRounded, this.createStart);
        const max = Math.max(mouseRounded, this.createStart);

        this.createEvent.start = DateFunctions.fromMillisToDateTimeStr(min);
        this.createEvent.end = DateFunctions.fromMillisToDateTimeStr(max);
      }
    },
    endDrag() {
      this.dragTime = null;
      this.dragEvent = null;
      this.createEvent = null;
      this.createStart = null;
      this.extendOriginal = null;
      this.emit();
    },
    deleteEvent(event) {
      this.eventProxies = this.eventProxies.filter((e) => e !== event);
      this.emit();
    },
    cancelDrag() {
      if (this.createEvent) {
        if (this.extendOriginal) {
          this.createEvent.end = DateFunctions.fromMillisToDateTimeStr(this.extendOriginal);
        } else {
          this.eventProxies = this.eventProxies.filter(e !== this.createEvent);
          this.emit();
        }
      }
      this.createEvent = null;
      this.createStart = null;
      this.dragTime = null;
      this.dragEvent = null;
    },
    roundTime(time, down = true) {
      const roundTo = 15; // minutes
      const roundDownTime = roundTo * 60 * 1000;

      return down
        ? time - (time % roundDownTime)
        : time + (roundDownTime - (time % roundDownTime));
    },
    toTime(tms) {
      return DateFunctions.createToMillis({
        year: tms.year,
        month: tms.month,
        day: tms.day,
        hour: tms.hour,
        minute: tms.minute
      });
    },
  },
};
</script>

<style scoped lang="scss">
.v-event-draggable {
  padding-left: 6px;
}

.v-event-timed {
  user-select: none;
  -webkit-user-select: none;
}

.v-event-drag-bottom {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 4px;
  height: 4px;
  cursor: ns-resize;

  &::after {
    display: none;
    position: absolute;
    left: 50%;
    height: 4px;
    border-top: 1px solid white;
    border-bottom: 1px solid white;
    width: 16px;
    margin-left: -8px;
    opacity: 0.8;
    content: "";
  }

  &:hover::after {
    display: block;
  }
}
</style>
