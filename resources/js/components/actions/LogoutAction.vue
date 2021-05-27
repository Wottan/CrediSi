<template>
  <i-button @click="onClick" tooltip="LogOut" color="primary">
    <i-icon value="logout" />
  </i-button>
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