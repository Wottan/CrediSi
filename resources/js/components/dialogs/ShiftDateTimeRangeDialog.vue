<template >
  <i-dialog :value="show" @close="close" width="600">
    <i-card>
      <v-card-title> Rango </v-card-title>
      <shift-date-time-range-form @submit="close" />
    </i-card>
  </i-dialog>
</template>
<script>
import ShiftDateTimeRangeForm from "../forms/ShiftDateTimeRangeForm.vue";
export default {
  components: { ShiftDateTimeRangeForm },
  props: {
    show: {
      type: Boolean,
    },
  },
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>