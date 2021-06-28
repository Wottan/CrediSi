<template>
  <v-dialog
    :value="value"
    @input="$emit('close')"
    :width="width"
    :persistent="persistent"
  >
    <slot />
  </v-dialog>
</template>
<script>
export default {
  props: {
    value: {
      type: Boolean,
    },
    width: {
      type: String,
    },
    persistent: {
      type: Boolean,
      default: () => false,
    },
  },
};
</script>
