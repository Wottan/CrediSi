<template>
  <i-app-bar>
    <i-spacer></i-spacer>
    <login-info />
  </i-app-bar>
</template>
<script>
import LoginInfo from "../login/LoginInfo.vue";
export default {
  components: { LoginInfo },
};
</script>