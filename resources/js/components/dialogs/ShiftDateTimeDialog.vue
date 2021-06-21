<template >
  <i-dialog :value="show" @close="close" width="650" :persistent="false">
    <i-card>
      <v-card-title> Fecha/Hora </v-card-title>
      <shift-date-time-form @submit="close" />
    </i-card>
  </i-dialog>
</template>
<script>
import ShiftDateTimeForm from "../forms/ShiftDateTimeForm.vue";
export default {
  components: { ShiftDateTimeForm },
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