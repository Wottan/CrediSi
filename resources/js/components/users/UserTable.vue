<template>
  <i-container>
    <i-table :columns="columns" :rows="users" title="Usuarios">
      <template v-slot:expandedRow="{ row }">
        <user-info :user="row" />
      </template>
      <template v-slot:rowAction="{ row }">
        <i-button tooltip="Editar Usuario" @click="edit(row)">
          <i-icon value="edit" />
        </i-button>
      </template>
    </i-table>
    <user-edit-dialog
      :value="dialog"
      :user="editUser"
      @close="dialog = false"
    />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import UserEditDialog from "./UserEditDialog.vue";
import UserEditForm from "./UserEditForm.vue";
import UserInfo from "./UserInfo";
export default {
  components: {
    UserInfo,
    UserEditDialog,
    UserEditForm,
  },
  data() {
    return {
      columns: [
        { text: "Nombre", value: "name" },
        { text: "Email", value: "email" },
        { text: "Acciones", value: "actions", sortable: false },
        { text: "", value: "data-table-expand", sortable: false },
      ],
      dialog: false,
      editUser: {},
    };
  },
  computed: {
    ...mapGetters("users", ["users"]),
  },

  methods: {
    ...mapActions("users", ["load"]),

    edit(row) {
      this.editUser = row;
      this.dialog = true;
    },
  },

  created() {
    this.load();
  },
};
</script>