<template>
  <v-autocomplete
    :disabled="disabled"
    :value="value"
    :items="options"
    :filter="filter"
    item-text="label"
    item-value="value"
    :label="label"
    @input="$emit('input', $event)"
  />
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: null,
    },
    value: {
      type: Object,
      default: {},
    },
    options: {
      type: Array,
      default: [],
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    filter(item, query) {
      return item.label?.toLowerCase().includes(query?.toLowerCase());
    },
  },
};
</script>