<template >
  <i-dialog :value="true" @close="close" width="650">
    <v-card>
      <v-card-title> Editar Usuario </v-card-title>
      <user-edit-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import UserEditForm from "../forms/UserEditForm.vue";
export default {
  components: { UserEditForm },
  props: {
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
