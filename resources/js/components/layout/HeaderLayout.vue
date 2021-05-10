<template>
  <v-app-bar dense:true flat:true>
    <v-spacer></v-spacer>
    <login-info />
  </v-app-bar>
</template>
<script>
import LoginInfo from "./LoginInfo.vue";
export default {
  components: { LoginInfo },
};
</script>