<template>
  <v-select
    :items="options"
    :label="label"
    :value="value"
    @input="$emit('input', $event)"
  >
    <template v-slot:selection="{ item }">
      <slot name="itemSelected" :item="item"></slot>
    </template>
  </v-select>
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