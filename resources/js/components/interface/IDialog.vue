<template>
  <v-dialog :value="value" @input="$emit('close')" :width="width">
    <slot />
  </v-dialog>
</template>
<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: null,
    },
    width: {
      type: String,
      default: null,
    },
  },
};
</script>
