<template>
  <v-data-table
    :headers="headers"
    :sort-by="sortBy"
    :sort-desc="sortDesc"
    :loading="loading"
    loading-text="Cargando los datos..."
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
      'items-per-page-text': 'Registros por página',
      'items-per-page-all-text': 'Todos',
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

    <template v-slot:progress>
      <div
        style="height: 3px"
        class="v-progress-linear v-progress-linear--visible"
      >
        <div
          style="opacity: 0.3; left: 0%; width: 100%"
          class="v-progress-linear__background blue"
        ></div>
        <div class="v-progress-linear__buffer"></div>
        <div
          class="
            v-progress-linear__indeterminate
            v-progress-linear__indeterminate--active
          "
        >
          <div class="v-progress-linear__indeterminate long blue"></div>
          <div class="v-progress-linear__indeterminate short blue"></div>
        </div>
      </div>
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
import { deburr } from "lodash";
export default {
  data() {
    return {
      searchString: "",
      singleExpand: true,
      expanded: [],
    };
  },
  props: {
    rows: Array,
    columns: Array,
    title: String,
    sortBy: Array,
    sortDesc: Array,
    loading: Boolean,
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

      //uses deburr to ignore accents
      searchable = deburr(searchable.trim());

      if (!searchable) {
        return false;
      }

      return !deburr(searchString)
        .split(separator)
        .find(
          (word) =>
            !searchable.trim().toLowerCase().includes(word.toLowerCase())
        );
    },
  },
};
</script>