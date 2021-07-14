<template >
  <i-dialog :value="true" @close="close" width="700" :persistent="false">
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
  methods: {
    close(value) {
      this.$emit("close", value);
    },
  },
};
</script>