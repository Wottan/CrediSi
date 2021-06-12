<template>
  <v-calendar
    :now="value"
    :value="value"
    :events="events"
    :event-color="eventColor"
    :type="type"
    :first-time="firstTime"
    :interval-count="intervals"
    :weekdays="weekDays"
    @mousedown:event="startDrag"
    @mousedown:time="startTime"
    @mousemove:time="mouseMove"
    @mouseup:time="endDrag"
    @mouseleave.native="cancelDrag"
  >
    <template v-slot:event="{ event, timed, eventSummary }">
      <div class="v-event-draggable" v-html="eventSummary()" />
      <div
        v-if="timed"
        class="v-event-drag-bottom"
        @mousedown.stop="extendBottom(event)"
      />
    </template>
  </v-calendar>
</template>
<script>
import { cloneDeep } from "lodash";
import { DateTime } from 'luxon';

export default {
  props: {
    value: {
      type: String,
      default: () => DateTime.now().toISODate()
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
    weekDays: [0,1,2,3,4,5,6],
    dragEvent: null,
    dragStart: null,
    createEvent: null,
    createStart: null,
    extendOriginal: null,
  }),
  methods: {
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
        const start = this.dragEvent.start;

        this.dragTime = mouse - start;
      } else {
        this.createStart = this.roundTime(mouse);
        this.createEvent = {
          name: "Disponible",
          color: this.eventColor,
          start: this.createStart,
          end: this.createStart + (1000 * 60 * 60) ,
          timed: true,
        };

        this.emit([...this.events, this.createEvent]);
      }
    },
    emit(events) {
      this.$emit("input", events);
    },
    extendBottom(event) {
      this.createEvent = event;
      this.createStart = event.start;
      this.extendOriginal = event.end;
    },
    mouseMove(tms) {
      const mouse = this.toTime(tms);

      if (this.dragEvent && this.dragTime !== null) {
        const start = this.dragEvent.start;
        const end = this.dragEvent.end;
        const duration = end - start;
        const newStartTime = mouse - this.dragTime;
        const newStart = this.roundTime(newStartTime);
        const newEnd = newStart + duration;

        this.dragEvent.start = newStart;
        this.dragEvent.end = newEnd;
      } else if (this.createEvent && this.createStart !== null) {
        const mouseRounded = this.roundTime(mouse, false);
        const min = Math.min(mouseRounded, this.createStart);
        const max = Math.max(mouseRounded, this.createStart);

        this.createEvent.start = min;
        this.createEvent.end = max;
      }
    },
    endDrag() {
      this.dragTime = null;
      this.dragEvent = null;
      this.createEvent = null;
      this.createStart = null;
      this.extendOriginal = null;
    },
    cancelDrag() {
      if (this.createEvent) {
        if (this.extendOriginal) {
          this.createEvent.end = this.extendOriginal;
        } else {
          const i = this.events.indexOf(this.createEvent);
          if (i !== -1) {
            this.emit(this.events.splice(i, 1));
          }
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
      return new Date(
        tms.year,
        tms.month - 1,
        tms.day,
        tms.hour,
        tms.minute
      ).getTime();
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
    content: '';
  }

  &:hover::after {
    display: block;
  }
}
</style>
