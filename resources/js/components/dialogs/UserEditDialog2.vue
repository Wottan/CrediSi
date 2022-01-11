<template >
  <i-dialog :value="true" @close="close" width="650">
    <v-card>
      <v-card-title> {{ value ? "Editar" : "Crear" }} Abonado </v-card-title>
      <user-edit-form-2 :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import UserEditForm2 from "../forms/UserEditForm2.vue";
export default {
  components: { UserEditForm2 },
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

