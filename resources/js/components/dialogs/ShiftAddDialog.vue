<template >
  <i-dialog :value="value" @close="close">
    <v-card>
      <v-card-title> Agregar turno </v-card-title>
      <shift-add-form @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import ShiftAddForm from "../forms/ShiftAddForm.vue";

export default {
  components: { ShiftAddForm },
  props: {
    value: {
      type: Boolean,
      required: true,
    },
  },

  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
