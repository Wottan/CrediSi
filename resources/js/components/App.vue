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
    ...mapActions("messages", ["error"]),
  },
  created() {
    this.$route.query.error && this.error(this.$route.query.error);
    this.check().catch((err) => {
      if (this.$route.name !== "login") {
        this.$router.push({ name: "login" });
      }
    });
  },
};
</script>
