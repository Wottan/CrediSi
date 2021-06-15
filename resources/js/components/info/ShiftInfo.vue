<template>
  <i-container>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column align-self="start" :cols="10">
          <i-card-text> Nombre: {{ value.name }} </i-card-text>
          <i-card-text> Etiquetas: <labels-info :value="value.labels" /> </i-card-text>
        </i-grid-column>
        <i-grid-column align-self="stretch" :cols="2">
          <i-button tooltip="Etiquetas" @click="openShiftLabelDialog">
            <i-icon value="label" />
          </i-button>
          <i-button tooltip="Horario" @click="showEditDialog = true">
            <i-icon value="edit" />
          </i-button>
          <i-button tooltip="Eliminar" @click="showDeleteDialog = true">
            <i-icon value="delete" />
          </i-button>
        </i-grid-column>
      </i-grid-row>
      <shift-label-dialog
        :show="showLabelDialog"
        :value="selectedUser"
        @close="onShiftLabelDialogClose"
      />
      <shift-dialog
        :show="showEditDialog"
        :value="value"
        @close="showEditDialog = false"
      />
      <shift-delete-dialog
        :show="showDeleteDialog"
        :value="value"
        @close="showDeleteDialog = false"
        @delete="onDelete"
      />
    </i-grid>
    <i-card-text v-else> No hay usuario disponible </i-card-text>
  </i-container>
</template>

<script>
import { mapActions } from "vuex";
import ShiftDeleteDialog from "../dialogs/ShiftDeleteDialog.vue";
import ShiftLabelDialog from "../dialogs/ShiftLabelDialog.vue";
import ShiftDialog from "../dialogs/ShiftDialog.vue";
import LabelsInfo from "../info/LabelsInfo.vue";

export default {
  components: { ShiftLabelDialog, ShiftDialog, ShiftDeleteDialog, LabelsInfo },
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
      selectedUser: {},
    };
  },
  methods: {
    ...mapActions("messages", ["info"]),

    openShiftLabelDialog() {
      this.selectedUser = this.value;
      this.showLabelDialog = true;
    },
    onShiftLabelDialogClose() {
      this.showLabelDialog = false;
      this.selectedUser = {};
    },
    onDelete() {
      this.info("El turno fue borrado con exito");
    },
  },
};
</script>