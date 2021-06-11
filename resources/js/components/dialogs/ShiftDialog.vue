<template >
  <i-dialog :value="show" @close="close">
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
    show: {
      type: Boolean
    },
    value: {
      type: Object,
      required: false,
    },
  },

  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
