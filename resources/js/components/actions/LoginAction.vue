<template>
  <i-button @click="onClick" tooltip="LogIn" color="primary">
    <i-icon value="login" />
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