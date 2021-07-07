<template>
  <i-div v-if="value" flex>
    <i-button-icon
      value="label"
      tooltip="Etiquetar"
      @click="showLabelDialog = true"
    />
    <shift-label-dialog
      v-if="showLabelDialog"
      :value="value"
      @close="showLabelDialog = false"
    />

    <i-button-icon
      value="edit"
      tooltip="Editar"
      @click="showEditDialog = true"
    />
    <shift-dialog
      v-if="showEditDialog"
      :value="value"
      @close="showEditDialog = false"
    />

    <i-button-icon
      value="delete"
      tooltip="Eliminar"
      @click="showDeleteDialog = true"
    />
    <shift-delete-dialog
      v-if="showDeleteDialog"
      :value="value"
      @close="showDeleteDialog = false"
      @delete="onDelete"
    />
  </i-div>
</template>

<script>
import { mapActions } from "vuex";
import ShiftDeleteDialog from "../dialogs/ShiftDeleteDialog.vue";
import ShiftLabelDialog from "../dialogs/ShiftLabelDialog.vue";
import ShiftDialog from "../dialogs/ShiftDialog.vue";

export default {
  components: {
    ShiftLabelDialog,
    ShiftDialog,
    ShiftDeleteDialog,
  },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      showLabelDialog: false,
      showEditDialog: false,
      showDeleteDialog: false,
    };
  },
  methods: {
    ...mapActions("messages", ["info"]),
    onDelete() {
      this.info("El turno fue borrado con exito");
    },
  },
};
</script>