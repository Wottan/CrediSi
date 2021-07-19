<template>
  <i-card>
    <i-select-input :options="options" :label="label" @input="onInput">
      <template v-slot:itemSelected="item">
        <select-info :value="item" :date="date" />
      </template>
    </i-select-input>
    <shift-date-time-dialog v-if="showDateTime" @close="onClose" />
    <shift-date-time-range-dialog v-if="showRange" @close="showRange = false" />
  </i-card>
</template>
<script>
import { mapActions } from "vuex";
import { DateFunctions } from "../../dates";
import ShiftDateTimeDialog from "../dialogs/ShiftDateTimeDialog.vue";
import ShiftDateTimeRangeDialog from "../dialogs/ShiftDateTimeRangeDialog.vue";
import SelectInfo from "../info/SelectInfo.vue";
export default {
  components: { ShiftDateTimeDialog, ShiftDateTimeRangeDialog, SelectInfo },
  data() {
    return {
      options: [
        { value: "load", text: "todos" },
        { value: "today", text: "activos hoy" },
        { value: "active", text: "activos ahora" },
        {
          value: "openDateTimeDialog",
          text: "activos en fecha/hora",
        },
      ],
      showDateTime: false,
      showRange: false,
      date: "",
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

    onClose(value) {
      this.date = value;
      this.showDateTime = false;
    },

    onInput(value) {
      this.date = "";
      this[value](DateFunctions.currentDateTimeStr());
    },
  },
};
</script>