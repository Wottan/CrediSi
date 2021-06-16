<template>
  <i-div>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column align-self="start" :cols="10">
          <i-card-text> Nombre: {{ value.name }} </i-card-text>
          <i-card-text> Etiquetas: <labels-info :value="value.labels" /> </i-card-text>
          <i-card-text> Email: {{ value.email }} </i-card-text>
          <i-card-text> Ingreso: {{ value.admission_date }} </i-card-text>
          <i-card-text> Telefono: {{ value.phone }} </i-card-text>
        </i-grid-column>
        <i-grid-column align-self="stretch" :cols="2">
          <i-grid>
            <i-grid-row>
              <i-grid-column> 
                <i-button-icon value="label" tooltip="Etiquetas" @click="showUserlabelDialog = true" />
                <i-button-icon value="shift" tooltip="Turnos" @click="showUserShiftsDialog = true" />
              </i-grid-column>
            </i-grid-row>
            <i-grid-row>
              <i-grid-column> 
                <i-button-icon value="timeoff" tooltip="Inasistencias / Vacaciones" />
              </i-grid-column>
            </i-grid-row>
          </i-grid>
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
  </i-div>
</template>

<script>
import UserLabelDialog from "../dialogs/UserLabelDialog.vue";
import UserShiftsDialog from "../dialogs/UserShiftsDialog.vue";
import LabelsInfo from "../info/LabelsInfo.vue";

export default {
  components: { UserLabelDialog, UserShiftsDialog, LabelsInfo },
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