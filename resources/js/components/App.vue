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
    this.check().catch(this.handleError);
  },
}
</script>
