<template>
  <i-container>
    <i-table :columns="columns" :rows="shifts" title="Turnos">
      <template v-slot:actions>
        <shift-selector label="Filtrar Tabla" @input="onInput" />
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
import LabelsInfo from '../info/LabelsInfo.vue';
import ShiftInfo from "../info/ShiftInfo";
import ShiftSelector from "../selectors/ShiftSelector.vue";

export default {
  components: {
    ShiftInfo,
    ShiftDialog,
    ShiftSelector,
    LabelsInfo,
  },
  data() {
    return {
      columns: [
        { text: "Usuario", value: "user", searchable: (row) => row.user.name },
        { text: "Nombre", value: "name" },
        { text: "Etiquetas", value: "labels", searchable: (row) => row.labels.map(l => l.text).join(' ') },
      ],
      showDialog: false,
      selectedRow: null,
    };
  },
  computed: {
    ...mapGetters("shifts", ["shifts"]),
  },

  methods: {
    ...mapActions("shifts", ["load", "today", "active"]),

    onInput(id) {
      if (id === 1) {
        this.load();
      } else if (id === 2) {
        this.today();
      } else {
        this.active();
      }
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