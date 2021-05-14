<template>
  <div>
    {{ user.name }}
    <login-action />
    <logout-action />
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import LoginAction from "../actions/LoginAction.vue";
import LogoutAction from "../actions/LogoutAction.vue";
export default {
  components: { LoginAction, LogoutAction },
  computed: {
    ...mapGetters("auth", ["user"]),
  },
};
</script>