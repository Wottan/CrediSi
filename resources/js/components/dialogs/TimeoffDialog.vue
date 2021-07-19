<template >
  <i-dialog :value="true" @close="close" width="650">
    <v-card>
      <v-card-title> {{ value ? "Editar" : "Crear" }} Inasistencia </v-card-title>
      <timeoff-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import TimeoffForm from "../forms/TimeoffForm.vue";

export default {
  components: { TimeoffForm },

  props: {
    value: {
      type: Object,
    },
  },
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>