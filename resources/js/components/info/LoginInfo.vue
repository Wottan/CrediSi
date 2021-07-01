<template>
  <i-div>
    <i-grid>
      <i-grid-row>
        <i-grid-column>{{ user.name }}</i-grid-column>
        <i-grid-column>
          <login-action v-if="!login" />
          <logout-action v-if="login" />
        </i-grid-column>
      </i-grid-row>
    </i-grid>
  </i-div>
</template>
<script>
import { mapState } from "vuex";
import LoginAction from "../actions/LoginAction.vue";
import LogoutAction from "../actions/LogoutAction.vue";
import IGridRow from "../interface/IGridRow.vue";
export default {
  components: { LoginAction, LogoutAction, IGridRow },
  computed: {
    ...mapState("auth", ["user", "login"]),
  },
};
</script>