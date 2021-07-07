<template>
  <v-text-field
    :value="value"
    :label="label"
    @input="$emit('input', $event)"
    :type="show ? 'text' : 'password'"
    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
    @click:append="show = !show"
    :error-messages="errors"
  >
  </v-text-field>
</template>
<script>
export default {
  data: () => ({
    show: false,
  }),

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