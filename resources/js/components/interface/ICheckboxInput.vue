<template>
    <v-checkbox class="ma-0"
      :input-value="value"
      :label="label"
      @change="$emit('input', $event)"
    >
    </v-checkbox>
</template>
<script>
export default {
  props: {
    value: {
      type: Boolean,
    },
    label: {
      type: String,
    },
  },
};
</script>