<template>
  <i-div v-if="value" flex>
    <!-- <i-button-icon
      value="label"
      tooltip="Etiquetar"
      @click="showUserlabelDialog = true"
    />
    <labeler-dialog
      v-if="showUserlabelDialog"
      :value="value"
      target="user"
      @close="showUserlabelDialog = false"
    /> -->

    <!-- <i-button-icon
      value="shift"
      tooltip="Ver Turnos"
      @click="showUserShiftsDialog = true"
    />
    <user-shifts-dialog
      v-if="showUserShiftsDialog"
      :value="value"
      @close="showUserShiftsDialog = false"
    /> -->

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
import LabelerDialog from "../dialogs/LabelerDialog.vue";
import UserEditDialog from "../dialogs/UserEditDialog.vue";
import UserEditDialog2 from "../dialogs/UserEditDialog2.vue";
import UserShiftsDialog from "../dialogs/UserShiftsDialog.vue";
import LabelsInfo from "../info/LabelsInfo.vue";

export default {
  components: {
    UserShiftsDialog,
    LabelsInfo,
    UserEditDialog,
    LabelerDialog,
    UserEditDialog2,
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