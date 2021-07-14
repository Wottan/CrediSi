<template>
  <div :style="[wide ? { width: '100%' } : {}]" :class="css">
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
      validator: (v) =>
        ["center", "right", "left", null].includes(v),
    },
  },
  computed:{
    css(){
      const align = this.align && "text-"+this.align;
      const flex = this.flex && "d-flex";
      return align + " " + flex; 
    }
  }
};
</script>

