<template>
    <v-chip :color="color" class="ma-1"><slot /></v-chip>
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