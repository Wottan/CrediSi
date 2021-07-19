<template>
  <i-container>
    <i-table :columns="columns" :sort-by="['name']" :rows="users" title="Usuarios" :loading="loading">
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
          sortable: false,
          sort: (a, b) =>
            a.labels?.map((l) => l.text).join() > b.labels?.map((l) => l.text).join(),
          searchable: (row) => row.labels?.map((l) => l.text).join(" "),
        },
      ],
      showUserEditDialog: false,
      loading: false
    };
  },
  computed: {
    ...mapGetters("users", ["users"]),
  },

  methods: {
    ...mapActions("users", ["load"]),
  },

  created() {
    this.loading = true;
    this.load().finally(() => this.loading = false);
  },
};
</script>