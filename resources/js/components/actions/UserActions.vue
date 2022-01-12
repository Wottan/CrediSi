<template>
  <i-div v-if="value" flex>
    <i-button-icon
      value="edit"
      tooltip="Editar"
      @click="showEditUserDialog = true"
    />
    <user-edit-dialog-2
      v-if="showEditUserDialog"
      :value="value"
      @close="showEditUserDialog = false"
    />
    <i-button-icon value="delete" tooltip="Eliminar" @confirm="onDelete" />
  </i-div>
</template>

<script>
import { mapActions } from "vuex";

import UserEditDialog2 from "../dialogs/UserEditDialog2.vue";

export default {
  components: {
    UserEditDialog2,
  },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      showEditUserDialog: false,
    };
  },
  methods: {
    ...mapActions("abonados", ["delete"]),
    ...mapActions("messages", ["handleError"]),
    onDelete() {
      this.delete(this.value)
        .then(() => {
          this.$emit("delete");
        })
        .catch(this.handleError);
    },
  },
};
</script>