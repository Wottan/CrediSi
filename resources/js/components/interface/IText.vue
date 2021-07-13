<template>
  <i-div wide :class="spanCss" :align="align">
      <slot />
  </i-div>
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
    align: {
      type: String,
      validator: (v) =>
        ["center", "right", "left", null].includes(v),
    },
  },
  computed: {
      spanCss(){
        return this.color && this.color + '--text';
      }
  }
};
</script>