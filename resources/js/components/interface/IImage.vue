<template>
  <v-img :src="src" :height="height" :width="width" contain />
</template>
<script>
const IMAGES = {
  logo: "logo.png",
};
export default {
  props: {
    value: {
      type: String,
      validator: (v) => v in IMAGES,
    },
    height: {
      type: String
    },
    width: {
      type: String
    },
  },

  computed: {
    src() {
      return "./img/" + IMAGES[this.value];
    },
  },
};
</script>