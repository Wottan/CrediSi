<template>
  <i-card>
    <i-select :options="options" :label="label" @input="onInput" />
    <shift-date-time-dialog
      :show="showDateTime"
      @close="showDateTime = false"
    />
    <shift-date-time-range-dialog
      :show="showRange"
      @close="showRange = false"
    />
  </i-card>
</template>
<script>
import { mapActions } from "vuex";
import ShiftDateTimeDialog from "../dialogs/ShiftDateTimeDialog.vue";
import ShiftDateTimeRangeDialog from "../dialogs/ShiftDateTimeRangeDialog.vue";
export default {
  components: { ShiftDateTimeDialog, ShiftDateTimeRangeDialog },
  data() {
    return {
      options: [
        { value: "load", text: "todos" },
        { value: "today", text: "hoy" },
        { value: "active", text: "ahora" },
        { value: "openDateTimeDialog", text: "fecha/hora" },
      ],
      showDateTime: false,
      showRange: false,
    };
  },
  props: {
    label: {
      type: String,
    },
  },
  methods: {
    ...mapActions("shifts", ["load", "today", "active"]),

    openDateTimeDialog() {
      this.showDateTime = true;
    },

    openDateTimeRangeDialog() {
      this.showRange = true;
    },

    onInput(value) {
      this[value]();
    },
  },
};
</script>