<template>
  <i-container>
    <i-table :columns="columns" :rows="users" title="Usuarios">
      <template v-slot:labels="{ row }">
        <labels-info :value="row.labels" />
      </template>
      <template v-slot:expandedRow="{ row }">
        <user-info :value="row" />
      </template>
      <template v-slot:rowAction="{  }">
        <i-button-icon
          value="timeoff"
          tooltip="Reportar/Justificar inasistencia"
        />
      </template>
    </i-table>
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import UserInfo from "../info/UserInfo";
import LabelsInfo from "../info/LabelsInfo";
export default {
  components: {
    UserInfo,
    LabelsInfo,
  },
  data() {
    return {
      columns: [
        { text: "Nombre", value: "name" },
        { text: "Email", value: "email" },
        { text: "Etiquetas", value: "labels", searchable: (row) => row.labels?.map(l => l.text).join(' ') },
      ],
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