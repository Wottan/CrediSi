<template>
  <div :style="[wide ? { width: '100%' } : {}]"><slot></slot></div>
</template>
<script>
export default {
  props: {
    wide: Boolean,
  },
};
</script>

