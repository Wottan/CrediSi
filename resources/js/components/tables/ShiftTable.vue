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
      <template v-slot:expandedRow="{ row }">
        <shift-info :value="row" />
      </template>
      <template v-slot:rowAction="{ row }">
        <i-button-icon
          value="edit"
          tooltip="Editar turno"
          @click="openEditDialog(row)"
        />
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
import ShiftInfo from "../info/ShiftInfo";
import ISpacer from "../interface/ISpacer.vue";
import ShiftSelector from "../selectors/ShiftSelector.vue";

export default {
  components: {
    ShiftInfo,
    ShiftDialog,
    ShiftSelector,
    ISpacer,
  },
  data() {
    return {
      columns: [{ text: "Nombre", value: "name" }],
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