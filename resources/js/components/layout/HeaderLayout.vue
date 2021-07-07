<template>
  <i-app-bar>
    <i-spacer></i-spacer>
    <login-info />
  </i-app-bar>
</template>
<script>
import LoginInfo from "../info/LoginInfo.vue";
export default {
  components: { LoginInfo },
};
</script>