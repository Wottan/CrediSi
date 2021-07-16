<template>
  <div :style="style" :class="css">
    <slot />
  </div>
</template>
<script>
export default {
  props: {
    wide: Boolean,
    flex: Boolean,
    align: {
      type: String,
      validator: (v) => ["center", "right", "left", null].includes(v),
    },
  },
  computed: {
    css() {
      return [
        this.align && "text-" + this.align, this.flex && "d-flex"
      ];
    },
    style() {
      return [
        this.wide && { width: "100%" },
      ];
    },
  },
};
</script>

