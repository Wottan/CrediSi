<template>
  <v-time-picker
    :value="value"
    @input="$emit('input', $event)"
    :format="format"
  ></v-time-picker>
</template>
<script>
export default {
  props: {
    value: {
      type: String,
      default: () => null,
    },
    format: {
      type: String,
      default: () => "ampm",
    },
  },
};
</script>