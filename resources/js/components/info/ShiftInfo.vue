<template>
  <i-container>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column align-self="start" :cols="10">
          <i-card-text> ID: {{ value.id }} </i-card-text>
        </i-grid-column>
        <i-grid-column align-self="stretch" :cols="2">
          <i-button tooltip="Etiquetas" @click="showLabelDialog = true">
            <i-icon value="label" />
          </i-button>
          <i-button tooltip="Horario" @click="showEditDialog = true">
            <i-icon value="edit" />
          </i-button>
        </i-grid-column>
      </i-grid-row>
      <shift-label-dialog
        :show="showLabelDialog"
        :value="value"
        @close="showLabelDialog = false"
      />
      <shift-dialog
        :show="showEditDialog"
        :value="value"
        @close="showEditDialog = false"
      />
    </i-grid>
    <i-card-text v-else> No hay usuario disponible </i-card-text>
  </i-container>
</template>

<script>
import ShiftLabelDialog from "../dialogs/ShiftLabelDialog.vue";
import ShiftDialog from "../dialogs/ShiftDialog.vue";

export default {
  components: { ShiftLabelDialog, ShiftDialog },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      showLabelDialog: false,
      showEditDialog: false,
    };
  },
  methods: {},
};
</script>