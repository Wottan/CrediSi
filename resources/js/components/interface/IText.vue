<template>
  <span :class="classes" :bold="bold">
      <slot />
  </span>
</template>
<script>
const COLORS = {
  red: "red",
};
export default {
  props: {
    color: {
      type: String,
      validator: (v) => !v || v in COLORS,
    },
    bold: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    classes() {
      return [
        this.color && this.color + '--text', this.bold && "font-weight-bold"
      ];
    },
  }
};
</script>