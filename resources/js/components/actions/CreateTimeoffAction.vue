<template>
  <i-div>
    <i-button tooltip="Agregar inasistencia" @click="showAddDialog = true">
      <i-icon value="add" />
    </i-button>
    <timeoff-dialog v-if="showAddDialog" @close="showAddDialog = false" />
  </i-div>
</template>
<script>
import TimeoffDialog from "../dialogs/TimeoffDialog.vue";

export default {
  components: {
    TimeoffDialog,
  },
  data() {
    return {
      showAddDialog: false,
    };
  },
};
</script>