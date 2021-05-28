<template>
  <v-dialog :value="value" @input="$emit('close')">
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
  },
};
</script>
