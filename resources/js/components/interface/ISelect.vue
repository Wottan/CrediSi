<template>
  <v-select
    :items="options"
    :label="label"
    :value="value"
    @input="$emit('input', $event)"
  ></v-select>
</template>
<script>
export default {
  props: {
    options: {
      type: Array,
    },
    label: {
      type: String,
    },
    value: {
      type: Object,
    },
  },
};
</script>