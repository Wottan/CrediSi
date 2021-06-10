<template>
  <i-container>
    <i-table :columns="columns" :rows="shifts" title="Turnos">
      <template v-slot:actions>
        <i-button tooltip="Agregar turno" @click="showAddDialog = true">
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
    <shift-edit-dialog
      :show="showEditDialog"
      :value="selected"
      @close="showEditDialog = false"
    />
    <shift-add-dialog :value="showAddDialog" @close="showAddDialog = false" />
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import ShiftEditDialog from "../dialogs/ShiftEditDialog.vue";
import ShiftAddDialog from "../dialogs/ShiftAddDialog.vue";

import ShiftInfo from "../info/ShiftInfo";

export default {
  components: {
    ShiftInfo,
    ShiftEditDialog,
    ShiftAddDialog
  },
  data() {
    return {
      columns: [
        { text: "Usuario", value: "user" },
        { text: "Acciones", value: "actions", sortable: false },
        { text: "", value: "data-table-expand", sortable: false },
      ],
      showEditDialog: false,
      showAddDialog: false,
      selected: {},
    };
  },
  computed: {
    ...mapGetters("shifts", ["shifts"]),
  },

  methods: {
    ...mapActions("shifts", ["load"]),

    openEditDialog(row) {
      this.selected = row;
      this.showEditDialog = true;
    },
  },

  created() {
    this.load();
  },
};
</script>