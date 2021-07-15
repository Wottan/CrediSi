<template>
  <i-button-icon
    value="logout"
    @click="onClick"
    tooltip="Cerrar Sesión"
    color="primary"
  />
</template>
<script>
import { mapActions } from "vuex";
export default {
  methods: {
    ...mapActions("auth", ["logout"]),
    onClick() {
      this.logout().then(() => {
        this.$router.push({ name: "login" });
      });
    },
  },
};
</script>