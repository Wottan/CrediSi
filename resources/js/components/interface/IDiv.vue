<template>
  <div :style="[wide ? { width: '100%' } : {}]" :class="[{ 'd-flex': flex }]">
    <slot />
  </div>
</template>
<script>
export default {
  props: {
    wide: Boolean,
    flex: Boolean,
  },
};
</script>

