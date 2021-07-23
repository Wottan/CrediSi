<template>
  <i-div v-if="value" flex>
    <i-button-icon
      value="label"
      tooltip="Etiquetar"
      @click="showUserlabelDialog = true"
    />
    <labeler-dialog
      v-if="showUserlabelDialog"
      :value="value"
      target="user"
      @close="showUserlabelDialog = false"
    />
    
    <i-button-icon
      value="shift"
      tooltip="Ver Turnos"
      @click="showUserShiftsDialog = true"
    />
    <user-shifts-dialog
      v-if="showUserShiftsDialog"
      :value="value"
      @close="showUserShiftsDialog = false"
    />
    
    <i-button-icon
      value="edit"
      tooltip="Editar"
      @click="showEditUserDialog = true"
    />
    <user-edit-dialog
      v-if="showEditUserDialog"
      :value="value"
      @close="showEditUserDialog = false"
    />

    <i-button-icon value="timeoff" tooltip="Reportar/Justificar inasistencia" /> 
  </i-div>
</template>

<script>
import LabelerDialog from '../dialogs/LabelerDialog.vue';
import UserEditDialog from "../dialogs/UserEditDialog.vue";
import UserShiftsDialog from "../dialogs/UserShiftsDialog.vue";
import LabelsInfo from "../info/LabelsInfo.vue";

export default {
  components: {
    UserShiftsDialog,
    LabelsInfo,
    UserEditDialog,
    LabelerDialog,
  },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      showUserlabelDialog: false,
      showUserShiftsDialog: false,
      showEditUserDialog: false,
    };
  },
};
</script>