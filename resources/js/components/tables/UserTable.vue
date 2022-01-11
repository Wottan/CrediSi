<template>
  <i-container>
    <i-table
      :columns="columns"
      :sort-by="['name']"
      :rows="abonados"
      title="Abonados"
      :loading="loading"
    >
      <template v-slot:tableActions>
        <create-user-action-2 />
      </template>
      <!-- <template v-slot:labels="{ row }">
        <labels-info :value="row.labels" />
      </template> -->
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
import CreateUserAction2 from "../actions/CreateUserAction2.vue";
export default {
  components: {
    UserInfo,
    LabelsInfo,
    UserActions,
    CreateUserAction2,
  },

  data() {
    return {
      columns: [
        { text: "Nombre", value: "name" },
        { text: "Apellido", value: "last_name" },
        { text: "Sexo", value: "sex" },
        { text: "Inicio", value: "start_date" },
        // {
        //   text: "Etiquetas",
        //   value: "labels",
        //   sortable: false,
        //   sort: (a, b) =>
        //     a.labels?.map((l) => l.text).join() >
        //     b.labels?.map((l) => l.text).join(),
        //   searchable: (row) => row.labels?.map((l) => l.text).join(" "),
        // },
      ],
      showUserEditDialog: false,
      loading: false,
    };
  },
  computed: {
    ...mapGetters("abonados", ["abonados"]),
  },

  methods: {
    ...mapActions("abonados", ["load"]),
  },

  created() {
    this.loading = true;
    this.load().finally(() => (this.loading = false));
  },
};
</script>