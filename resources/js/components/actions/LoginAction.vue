<template>
  <v-tooltip bottom v-if="!user.name">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        icon
        @click="onClick"
        color="primary"
        dark
        v-bind="attrs"
        v-on="on"
      >
        <v-icon>mdi-login</v-icon>
      </v-btn>
    </template>
    <span>LogIn</span>
  </v-tooltip>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters("auth", ["user"]),
  },
  methods: {
    onClick() {
      this.$router.push({ name: "login" });
    },
  },
};
</script>