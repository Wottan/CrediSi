<template>
  <i-container>
    <i-table :columns="columns" :rows="shifts" title="Turnos">
      <template v-slot:actions>
        <i-button tooltip="Agregar turno" @click="openAddDialog">
          <i-icon value="add" />
        </i-button>
      </template>
      <template v-slot:expandedRow="{ row }">
        <user-info :value="row" />
      </template>
      <template v-slot:rowAction="{ row }">
        <i-button tooltip="Editar turno" @click="openEditDialog(row)">
          <i-icon value="edit" />
        </i-button>
      </template>
    </i-table>
    <shift-dialog
      :show="showDialog"
      :value="selected"
      @close="showDialog = false"
    />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import ShiftDialog from "../dialogs/ShiftDialog.vue";

import ShiftInfo from "../info/ShiftInfo";

export default {
  components: {
    ShiftInfo,
    ShiftDialog
  },
  data() {
    return {
      columns: [
        { text: "Usuario", value: "user" },
        { text: "Acciones", value: "actions", sortable: false },
        { text: "", value: "data-table-expand", sortable: false },
      ],
      showDialog: false,
      selected: null,
    };
  },
  computed: {
    ...mapGetters("shifts", ["shifts"]),
  },

  methods: {
    ...mapActions("shifts", ["load"]),

    openEditDialog(row) {
      this.selected = row;
      this.showDialog = true;
    },
    openAddDialog() {
      this.selected = null;
      this.showDialog = true;
    },
  },

  created() {
    this.load();
  },
};
</script>