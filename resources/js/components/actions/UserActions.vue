<template>
  <i-div v-if="value" flex>
    <i-button-icon
      value="label"
      tooltip="Etiquetar"
      @click="showUserlabelDialog = true"
    />
    <user-label-dialog
      v-if="showUserlabelDialog"
      :value="value"
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
import UserEditDialog from "../dialogs/UserEditDialog.vue";
import UserLabelDialog from "../dialogs/UserLabelDialog.vue";
import UserShiftsDialog from "../dialogs/UserShiftsDialog.vue";
import LabelsInfo from "../info/LabelsInfo.vue";

export default {
  components: {
    UserLabelDialog,
    UserShiftsDialog,
    LabelsInfo,
    UserEditDialog,
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