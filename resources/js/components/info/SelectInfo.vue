<template>
  <i-div wide>
    {{ calculated }}
  </i-div>
</template>

<script>
export default {
  props: {
    value: {
      type: Object,
    },
    date: {
      type: String,
    },
  },

  computed: {
    calculated() {
      return this.date ? "activos en " + this.date : this.value.item.text;
    },
  },
};
</script>