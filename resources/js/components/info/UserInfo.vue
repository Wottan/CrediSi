<template>
  <i-container>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column align-self="start" :cols="10">
          <i-card-text> Nombre: {{ value.name }} </i-card-text>
          <i-card-text> Email: {{ value.email }} </i-card-text>
        </i-grid-column>
        <i-grid-column align-self="stretch" :cols="2">
          <i-button tooltip="Etiquetas" @click="showUserlabelDialog = true">
            <i-icon value="label" />
          </i-button>
          <i-button tooltip="Turnos" @click="showUserShiftsDialog = true">
            <i-icon value="shift" />
          </i-button>
        </i-grid-column>
      </i-grid-row>
      <user-label-dialog
        :show="showUserlabelDialog"
        :value="value"
        @close="showUserlabelDialog = false"
      />
      <user-shifts-dialog
        :show="showUserShiftsDialog"
        :value="value"
        @close="showUserShiftsDialog = false"
      />
    </i-grid>
    <i-card-text v-else> No hay usuario disponible </i-card-text>
  </i-container>
</template>

<script>
import UserLabelDialog from "../dialogs/UserLabelDialog.vue";
import UserShiftsDialog from "../dialogs/UserShiftsDialog.vue";

export default {
  components: { UserLabelDialog, UserShiftsDialog },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      showUserlabelDialog: false,
      showUserShiftsDialog: false,
    };
  },
  methods: {},
};
</script>