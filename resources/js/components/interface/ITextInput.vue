<template>
  <v-text-field :value="value" :label="label" @input="$emit('input', $event)">
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
  },
};
</script>