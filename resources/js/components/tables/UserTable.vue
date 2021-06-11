<template>
  <i-container>
    <i-table :columns="columns" :rows="users" title="Usuarios">
      <template v-slot:expandedRow="{ row }">
        <user-info :value="row" />
      </template>
      <template v-slot:rowAction="{ row }">
        <i-button tooltip="Editar Usuario" @click="openEditUserDialog(row)">
          <i-icon value="edit" />
        </i-button>
        <i-button tooltip="Agregar Etiqueta" @click="openEditLabelsDialog(row)">
          <i-icon value="label" />
        </i-button>
      </template>
    </i-table>
    <user-edit-dialog
      :show="showEditUserDialog"
      :value="selectedUser"
      @close="showEditUserDialog = false"
    />
    <user-label-dialog
      :show="showUserLabelDialog"
      :value="selectedUser"
      @close="onUserLabelDialogClose"
    />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import UserLabelDialog from "../dialogs/UserLabelDialog.vue";

import UserEditDialog from "../dialogs/UserEditDialog.vue";
import UserInfo from "../info/UserInfo";
export default {
  components: {
    UserInfo,
    UserEditDialog,
    UserLabelDialog,
  },
  data() {
    return {
      columns: [
        { text: "Nombre", value: "name" },
        { text: "Email", value: "email" },
        { text: "Acciones", value: "actions", sortable: false },
        { text: "", value: "data-table-expand", sortable: false },
      ],
      showEditUserDialog: false,
      selectedUser: {},
      showUserLabelDialog: false,
    };
  },
  computed: {
    ...mapGetters("users", ["users"]),
  },

  methods: {
    ...mapActions("users", ["load"]),
    onUserLabelDialogClose() {
      this.showUserLabelDialog = false;
      this.selectedUser = {};
    },
    openEditUserDialog(row) {
      this.selectedUser = row;
      this.showEditUserDialog = true;
    },
    openEditLabelsDialog(row) {
      this.selectedUser = row;
      this.showUserLabelDialog = true;
    },
  },

  created() {
    this.load();
  },
};
</script>