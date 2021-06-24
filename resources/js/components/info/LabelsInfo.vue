<template>
  <i-div>
    <i-chip v-for="label in value" v-bind:key="label.id">
      {{ label.text }}
    </i-chip>
  </i-div>
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