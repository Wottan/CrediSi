<template >
  <i-dialog :value="true" @close="close">
    <v-card>
      <v-card-title> Turno </v-card-title>
      <shift-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import ShiftForm from "../forms/ShiftForm.vue";

export default {
  components: { ShiftForm },
  props: {
    value: {
      type: Object
    },
  },
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
