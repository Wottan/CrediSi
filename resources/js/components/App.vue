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
    ...mapActions("messages", ["error"]),
  },
  created() {
    this.$route.query.error && this.error(this.$route.query.error);
  },
};
</script>
