<template>
  <v-text-field
    :value="value"
    :label="label"
    @input="$emit('input', $event)"
    :error-messages="errors"
  >
  </v-text-field>
</template>
<script>
export default {
  props: {
    value: {
      type: String,
    },
    label: {
      type: String,
    },
    errors: {
      type: Array,
    },
  },
};
</script>