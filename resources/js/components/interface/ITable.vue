<template>
  <v-data-table
    :headers="columns"
    :items="rows"
    :search="searchString"
    :single-expand="singleExpand"
    :expanded.sync="expanded"
    item-key="id"
    :show-expand="canExpand"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>{{ title }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="searchString"
          append-icon="mdi-magnify"
          label="Buscar"
          single-line
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-switch
          v-if="canExpand"
          v-model="singleExpand"
          label="Expandir solo uno"
          class="mt-2"
        ></v-switch>
      </v-toolbar>
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
      expanded: [] 
    };
  },
  props: {
    rows: {
      type: Array,
      default: null,
    },
    columns: {
      type: Array,
      default: null,
    },
    title: {
      type: String,
      default: "",
    },
  },
  computed: {
    canExpand() {
      return !!this.$scopedSlots.expandedRow;
    } 
  }
};
</script>