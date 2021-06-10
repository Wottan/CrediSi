<template >
  <i-dialog :value="show" @close="close">
    <v-card>
      <v-card-title> Editar turno </v-card-title>
      <shift-edit-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import ShiftEditForm from "../forms/ShiftEditForm.vue";
export default {
  components: { ShiftEditForm },
  props: {
    show: {
      type: Boolean,
      required: true,
    },
    value: {
      type: Object,
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
