<template>
  <i-div>
    <i-chip v-for="label in value" v-bind:key="label.id" :color="label.color">
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