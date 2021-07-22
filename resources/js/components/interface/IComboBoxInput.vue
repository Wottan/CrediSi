<template>
  <v-combobox
    :items="options"
    :label="label"
    multiple
    :search-input.sync="search"
    small-chips
    :hide-no-data="!search"
    hide-selected
    :value="value"
    :menu-props="menuProps"
    @input="$emit('input', $event)"
  >
    <template v-slot:no-data>
      <v-list-item>
        <span>Presiona <kbd>enter</kbd> para crear</span>
        <v-chip label small>
          {{ search }}
        </v-chip>
      </v-list-item>
    </template>
  </v-combobox>
</template>

<script>
export default {
  data() {
    return {
      search: null,
      menuProps:{
        closeOnContentClick: true,
      },
    };
  },
  props: {
    options: {
      type: Array
    },
    label: {
      type: String
    },
    value: {
      type: Array,
    },
  },
};
</script>