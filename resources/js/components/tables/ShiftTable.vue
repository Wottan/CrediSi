<template>
  <i-container>
    <i-table :columns="columns" :rows="shifts" title="Turnos">
      <template v-slot:tableActions>
        <shift-filter-selector label="Filtrar turnos" />
        <i-spacer />
        <i-button tooltip="Agregar turno" @click="openAddDialog">
          <i-icon value="add" />
        </i-button>
      </template>
      <template v-slot:user="{ row }">
        {{ row.user.name }}
      </template>
      <template v-slot:labels="{ row }">
        <labels-info :value="row.labels" />
      </template>
      <template v-slot:expandedRow="{ row }">
        <shift-info :value="row" />
      </template>
    </i-table>
    <shift-dialog
      v-if="showDialog"
      show
      :value="selectedRow"
      @close="showDialog = false"
    />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import ShiftDialog from "../dialogs/ShiftDialog.vue";
import LabelsInfo from "../info/LabelsInfo.vue";
import ShiftInfo from "../info/ShiftInfo";
import ShiftFilterSelector from "../selectors/ShiftFilterSelector.vue";

export default {
  components: {
    ShiftInfo,
    ShiftDialog,
    LabelsInfo,
    ShiftFilterSelector,
  },
  data() {
    return {
      columns: [
        { text: "Usuario", value: "user", searchable: (row) => row.user?.name },
        { text: "Nombre", value: "name" },
        {
          text: "Etiquetas",
          value: "labels",
          searchable: (row) => row.labels.map((l) => l.text).join(" "),
        },
      ],
      showDialog: false,
      selectedRow: null,
      show: false,
    };
  },
  computed: {
    ...mapGetters("shifts", ["shifts"]),
  },

  methods: {
    ...mapActions("shifts", ["load"]),

    openEditDialog(row) {
      this.selectedRow = row;
      this.showDialog = true;
    },
    openAddDialog() {
      this.selectedRow = null;
      this.showDialog = true;
    },
  },
  created() {
    this.load();
  },
};
</script>