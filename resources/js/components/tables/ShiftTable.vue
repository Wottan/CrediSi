<template>
  <i-container>
    <i-table :columns="columns" :sort-by="['user.name']" :rows="shifts" title="Turnos" :loading="loading">
      <template v-slot:tableActions>
        <shift-filter-selector label="Filtrar turnos" />
        <i-spacer />
        <i-button tooltip="Agregar turno" @click="showAddDialog = true">
          <i-icon value="add" />
        </i-button>
      </template>
      <template v-slot:labels="{ row }">
        <labels-info :value="row.labels" />
      </template>
      <template v-slot:rowActions="{ row }">
        <shift-actions :value="row" />
      </template>
    </i-table>
    <shift-dialog v-if="showAddDialog" @close="showAddDialog = false" />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import LabelsInfo from "../info/LabelsInfo.vue";
import ShiftActions from "../actions/ShiftActions.vue";
import ShiftDialog from "../dialogs/ShiftDialog.vue";
import ShiftFilterSelector from "../selectors/ShiftFilterSelector.vue";

export default {
  components: {
    ShiftActions,
    LabelsInfo,
    ShiftFilterSelector,
    ShiftDialog,
  },
  data() {
    return {
      columns: [
        {
          text: "Usuario",
          value: "user.name"
        },
        {
          text: "Etiquetas",
          value: "labels",
          sortable: false,
          sort: (a, b) =>
            a.labels?.map((l) => l.text).join() > b.labels?.map((l) => l.text).join(),
          searchable: (row) => row.labels?.map((l) => l.text).join(),
        },
      ],
      showAddDialog: false,
      loading:false
    };
  },
  computed: {
    ...mapGetters("shifts", ["shifts"]),
  },

  methods: {
    ...mapActions("shifts", ["load"]),
  },
  created() {
    this.loading = true;
    this.load().finally(() => this.loading = false);
  },
};
</script>