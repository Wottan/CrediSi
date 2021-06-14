<template>
  <i-container>
    <i-chip v-for="label in value" v-bind:key="label.id">
      {{ label.text }}
    </i-chip>
  </i-container>
</template>

<script>
export default {
  props: {
    value: {
      type: Array,
    },
  },
};
</script>