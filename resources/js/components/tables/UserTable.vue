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
      </template>
    </i-table>
    <user-edit-dialog
      v-if="showEditUserDialog"
      :show="true"
      :value="selectedUser"
      @close="showEditUserDialog = false"
    />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import UserEditDialog from "../dialogs/UserEditDialog.vue";
import UserInfo from "../info/UserInfo";
export default {
  components: {
    UserInfo,
    UserEditDialog
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
    };
  },
  computed: {
    ...mapGetters("users", ["users"]),
  },

  methods: {
    ...mapActions("users", ["load"]),

    openEditUserDialog(row) {
      this.selectedUser = row;
      this.showEditUserDialog = true;
    },
  },

  created() {
    this.load();
  },
};
</script>