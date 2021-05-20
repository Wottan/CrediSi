<template>
  <i-button
    @click="onClick"
    :icon="'mdi-login'"
    :label="'LogIn'"
    :color="'primary'"
  >
  </i-button>
</template>
<script>
export default {
  methods: {
    onClick() {
      this.$router.push({ name: "login" });
    },
  },
};
</script>