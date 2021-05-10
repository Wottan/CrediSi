<template>
  <v-tooltip bottom v-if="user.name">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        icon
        @click="onClick"
        color="primary"
        dark
        v-bind="attrs"
        v-on="on"
      >
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </template>
    <span>Logout</span>
  </v-tooltip>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "logoutbutton",
  components: {},
  computed: {
    ...mapGetters("auth", ["user"]),
  },
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