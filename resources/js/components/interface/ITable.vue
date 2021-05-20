<template>
  <v-card>
    <v-card-title>
      {{ title }}
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Buscar"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="items"
      :search="search"
    ></v-data-table>
  </v-card>
</template>
<script>
export default {
  data() {
    return { search: "" };
  },

  props: {
    items: {
      type: Array,
      default: null,
    },
    headers: {
      type: Array,
      default: null,
    },
    title: {
      type: String,
      default: "",
    },
  },
};
</script>