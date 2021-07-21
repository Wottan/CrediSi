<template>
  <v-calendar
    :now="now"
    :value="now"
    :events="eventProxies"
    :type="type"
    :first-time="firstTime"
    :interval-count="intervals"
    :interval-height="intervalHeight"
    :interval-width="intervalWidth"
    :weekdays="weekDays"
    locale="es"
    @mousedown:event="startDrag"
    @mousedown:time="startTime"
    @mousemove:time="mouseMove"
    @mouseup:time="endDrag"
    @mouseleave.native="cancelDrag"
  >
    <template v-slot:day-label-header></template>
    <template v-slot:event="{ event, timed, eventSummary }">
      <i-grid class="pa-0">
        <i-grid-row>
          <i-grid-column cols="9">
            <div class="v-event-draggable" v-html="eventSummary()" />
          </i-grid-column>
          <i-grid-column v-if="editable" cols="1">
            <i-button-icon
              size="tiny"
              value="close"
              @click="deleteEvent(event)"
            />
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
import { cloneDeep, minBy, maxBy } from "lodash";
import { DateFunctions } from "../../dates";
export default {
  props: {
    value: String,
    type: {
      type: String,
      validator: (v) => ["week"].includes(v),
    },
    readonly: Boolean,
    events: Array,
  },
  data() {
    return {
      eventColor: "#2196F3",
      firstTime: "0:00",
      intervals: 24,
      intervalHeight: 40,
      intervalWidth: 40,
      weekDays: [1, 2, 3, 4, 5, 6, 0],
      dragEvent: null,
      dragStart: null,
      createEvent: null,
      createStart: null,
      extendOriginal: null,
      eventProxies: [],
    };
  },
  created() {
    this.initProxies();
    if (!this.editable) {
      this.initLimits();
    }
  },
  computed: {
    editable() {
      return !this.readonly && !!this.$listeners.input;
    },
    now() {
      return (
        DateFunctions.fromISOToDateTimeStr(this.value) ||
        this.dateLimits.min?.str ||
        DateFunctions.currentDateTimeStr()
      );
    },
    dateLimits() {
      const comparable = (dateStr) => {
        const date = DateFunctions.fromStr(dateStr);
        return {
          millis: date.toMillis(),
          str: date.toSQLDate(),
        };
      };
      return {
        min: minBy(
          this.eventProxies.map((e) => comparable(e.start)),
          "millis"
        ),
        max: maxBy(
          this.eventProxies.map((e) => comparable(e.end)),
          "millis"
        ),
      };
    },
    timeLimits() {
      const comparable = (dateStr) => {
        const date = DateFunctions.fromStr(dateStr);
        return {
          time: date.hour * 100 + date.minute, // 18:00 turns into 1800
          str: date.toSQLTime()
        };
      };
      return {
        min: minBy(
          this.eventProxies.map((e) => comparable(e.start)),
          "time"
        ),
        max: maxBy(
          this.eventProxies.map((e) => comparable(e.end)),
          "time"
        ),
      };
    },
  },
  methods: {
    initProxies() {
      this.eventProxies = cloneDeep(this.events).map((e) => ({
        ...e,
        start: DateFunctions.fromISOToDateTimeStr(e.start),
        end: DateFunctions.fromISOToDateTimeStr(e.end),
      }));
    },
    initLimits() {
      if (this.timeLimits.min && this.timeLimits.max) {
        let intervals = 0;
        let time = this.timeLimits.min.time;
        while (time <= this.timeLimits.max.time) {
          intervals++;
          time += 100;
        }
        this.firstTime = this.timeLimits.min.str;
        this.intervals = intervals;
      }
    },
    startDrag({ event, timed }) {
      if (this.editable && event && timed) {
        this.dragEvent = event;
        this.dragTime = null;
        this.extendOriginal = null;
      }
    },
    startTime(tms) {
      if (!this.editable) {
        return;
      }
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
          end: DateFunctions.fromMillisToDateTimeStr(
            this.createStart + 1000 * 60 * 60
          ),
          timed: true,
        };
        this.eventProxies.push(this.createEvent);
        this.emit();
      }
    },
    emit() {
      if (!this.editable) {
        return;
      }
      this.$emit("input", this.eventProxies);
    },
    extendBottom(event) {
      if (!this.editable) {
        return;
      }
      this.createEvent = event;
      this.createStart = DateFunctions.fromStrToMillis(event.start);
      this.extendOriginal = DateFunctions.fromStrToMillis(event.end);
    },
    mouseMove(tms) {
      if (!this.editable) {
        return;
      }
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
      if (!this.editable) {
        return;
      }
      this.dragTime = null;
      this.dragEvent = null;
      this.createEvent = null;
      this.createStart = null;
      this.extendOriginal = null;
      this.emit();
    },
    deleteEvent(event) {
      if (!this.editable) {
        return;
      }
      this.eventProxies = this.eventProxies.filter((e) => e !== event);
      this.emit();
    },
    cancelDrag() {
      if (!this.editable) {
        return;
      }
      if (this.createEvent) {
        if (this.extendOriginal) {
          this.createEvent.end = DateFunctions.fromMillisToDateTimeStr(
            this.extendOriginal
          );
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
        minute: tms.minute,
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
