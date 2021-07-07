<template>
  <i-container>
    <i-table :columns="columns" :rows="shifts" title="Turnos">
      <template v-slot:tableActions>
        <shift-filter-selector label="Filtrar turnos" />
        <i-spacer />
        <i-button tooltip="Agregar turno" @click="showAddDialog = true">
          <i-icon value="add" />
        </i-button>
      </template>
      <template v-slot:user="{ row }">
        {{ row.user && row.user.name }}
      </template>
      <template v-slot:labels="{ row }">
        <labels-info :value="row.labels" />
      </template>
      <template v-slot:rowActions="{ row }">
        <shift-actions :value="row" />
      </template>
    </i-table>
    <shift-dialog
      v-if="showAddDialog"
      @close="showAddDialog = false"
    />
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
    ShiftDialog
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
      showAddDialog: false,
    };
  },
  computed: {
    ...mapGetters("shifts", ["shifts"]),
  },

  methods: {
    ...mapActions("shifts", ["load"]),
  },
  created() {
    this.load();
  },
};
</script>