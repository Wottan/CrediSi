<template>
  <i-button
    @click="onClick"
    :icon="'mdi-logout'"
    :label="'LogOut'"
    :color="'primary'"
  >
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