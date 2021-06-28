<template>
    <v-chip :color="color"><slot /></v-chip>
</template>

<script>
export default {
  props: {
    color: {
      type: String,
    },
  },
};
</script>