<template>
  <i-button value="logout" @click="onClick" tooltip="LogOut" color="primary" />
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