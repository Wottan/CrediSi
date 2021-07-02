<template>
  <v-data-table
    :headers="headers"
    :items="rows"
    :search="searchString"
    :custom-filter="searchFilter"
    :single-expand="singleExpand"
    :expanded.sync="expanded"
    item-key="id"
    :show-expand="canExpand"
    no-data-text="No hay datos disponibles"
    no-results-text="No se encontraron conincidencias"
    next-page="Proxima pagina"
    prev-page="Pagina anterior"
    :footer-props="{
      'items-per-page-text': 'Items por pagina',
      'rows-per-page-all': 'Todos',
      'page-text': '{0}-{1} de {2}',
      'next-page': 'Proxima pagina',
      'prev-page': 'Pagina anterior',
    }"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>{{ title }}</v-toolbar-title>
        <v-spacer />
        <v-text-field
          v-model="searchString"
          append-icon="mdi-magnify"
          label="Buscar"
          single-line
        ></v-text-field>
        <v-spacer />
        <slot name="tableActions" />
        <v-spacer />
        <v-switch
          v-if="canExpand"
          v-model="singleExpand"
          label="Expandir solo uno"
          class="mt-2"
        ></v-switch>
      </v-toolbar>
    </template>

    <template v-slot:[`item.actions`]="{ item }">
      <slot name="rowActions" :row="item" />
    </template>

    <template v-for="slot in columnSlots" v-slot:[`item.${slot}`]="{ item }">
      <slot :name="slot" :row="item" />
    </template>

    <template v-slot:expanded-item="{ headers, item }">
      <td :colspan="headers.length">
        <slot name="expandedRow" :row="item">No se definieron mas datos</slot>
      </td>
    </template>
  </v-data-table>
</template>
<script>
export default {
  data() {
    return {
      searchString: "",
      singleExpand: false,
      expanded: [],
    };
  },
  props: {
    rows: {
      type: Array,
    },
    columns: {
      type: Array,
    },
    title: {
      type: String,
    },
  },
  computed: {
    canExpand() {
      return !!this.$scopedSlots.expandedRow;
    },
    hasActions() {
      return !!this.$scopedSlots.rowActions;
    },
    columnSlots() {
      return this.columns
        .map((c) => c.value)
        .filter((v) => !!this.$scopedSlots[v]);
    },
    headers() {
      let headers = [...this.columns];
      if (this.hasActions) {
        headers.push({ text: "Acciones", value: "actions", sortable: false });
      }
      if (this.canExpand) {
        headers.push({ text: "", value: "data-table-expand", sortable: false });
      }
      return headers;
    },
  },
  methods: {
    searchFilter(value, searchString, row) {
      const separator = " ";

      if (!searchString?.trim()) {
        return true;
      }

      let searchable = typeof value === "string" ? value : "";

      this.columns.forEach((c) => {
        if (c.searchable) {
          searchable += separator + c.searchable(row);
        }
      });

      searchable = searchable.trim();

      if (!searchable) {
        return false;
      }

      return !searchString
        .split(separator)
        .find(
          (word) =>
            !searchable.trim().toLowerCase().includes(word.toLowerCase())
        );
    },
  },
};
</script>