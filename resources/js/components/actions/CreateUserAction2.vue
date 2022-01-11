<template>
  <i-div>
    <i-button tooltip="Agregar abonado" @click="showAddDialog = true">
      <i-icon value="add" />
    </i-button>
    <user-edit-dialog-2 v-if="showAddDialog" @close="showAddDialog = false" />
  </i-div>
</template>
<script>
import UserEditDialog2 from "../dialogs/UserEditDialog2.vue";

export default {
  components: { UserEditDialog2 },

  data() {
    return {
      showAddDialog: false,
    };
  },
};
</script>