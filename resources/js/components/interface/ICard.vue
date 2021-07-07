<template>
    <v-card :elevation="elevation"><slot /></v-card>
</template>

<script>
export default {
  props: {
    elevation: {
      type: Number,
      default: () => 0
    }
  }
}
</script>