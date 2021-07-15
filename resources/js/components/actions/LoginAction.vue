<template>
  <i-button-icon value="login" @click="onClick" tooltip="Iniciar Sesión" color="primary" />
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