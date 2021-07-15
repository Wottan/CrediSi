<template>
  <i-container>
    <i-table :columns="columns" :sortBy="sortBy" :rows="users" title="Usuarios">
      <template v-slot:tableActions>
        <create-user-action />
      </template>
      <template v-slot:labels="{ row }">
        <labels-info :value="row.labels" />
      </template>
      <template v-slot:expandedRow="{ row }">
        <user-info :value="row" />
      </template>
      <template v-slot:rowActions="{ row }">
        <user-actions :value="row" />
      </template>
    </i-table>
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import UserInfo from "../info/UserInfo";
import LabelsInfo from "../info/LabelsInfo";
import UserActions from "../actions/UserActions";
import CreateUserAction from "../actions/CreateUserAction.vue";
export default {
  components: {
    UserInfo,
    LabelsInfo,
    UserActions,
    CreateUserAction,
  },

  data() {
    return {
      columns: [
        { text: "Nombre", value: "name" },
        {
          text: "Etiquetas",
          value: "labels",
          searchable: (row) => row.labels?.map((l) => l.text).join(" "),
        },
      ],
      showUserEditDialog: false,
      sortBy: ["name"],
    };
  },
  computed: {
    ...mapGetters("users", ["users"]),
  },

  methods: {
    ...mapActions("users", ["load"]),
  },

  created() {
    this.load();
  },
};
</script>