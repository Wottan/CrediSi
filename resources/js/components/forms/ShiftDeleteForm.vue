<template >
  <v-card>
    <v-card-title> Desea eliminar el turno? </v-card-title>
    <v-card-text
      >Todos los datos de este turno se borraran definitivamente</v-card-text
    >
    <v-card-actions>
      <i-button @click="$emit('close')"> Cancelar </i-button>
      <i-button @click="onSubmit"> OK </i-button>
    </v-card-actions>
  </v-card>
</template>
<script>
import { mapActions } from "vuex";

export default {
  props: {
    value: {
      type: Object,
    },
  },
  methods: {
    ...mapActions("shifts", ["delete"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.delete(this.value)
        .then(() => {
          this.$emit("submit");
        })
        .catch(this.handleError);
    },
  },
};
</script>