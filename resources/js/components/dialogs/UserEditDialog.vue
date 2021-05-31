<template >
  <i-dialog :value="value" @close="close">
    <v-card>
      <v-card-title> Editar Usuario </v-card-title>
      <user-edit-form :value="user" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import UserEditForm from "../forms/UserEditForm.vue";
export default {
  components: { UserEditForm },
  props: {
    value: {
      type: Boolean,
      required: true,
    },
    user: {
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
