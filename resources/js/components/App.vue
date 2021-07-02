<template>
  <i-app>
    <i-messages />
    <router-view></router-view>
  </i-app>
</template>

<script>
import { mapActions } from "vuex";

export default {
  methods: {
    ...mapActions("auth", ["check"]),
    ...mapActions("messages", ["handleError"]),
  },
  created() {
    this.check().catch((err) => {
      this.handleError(err);
      this.$router.push({ name: "login" });
    });
  },
};
</script>
