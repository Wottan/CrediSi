<template>
  <v-icon>{{ icon }}</v-icon>
</template>
<script>
const ICONS = {
  login: "mdi-login",
  logout: "mdi-logout",
  edit: "mdi-pencil",
  label: "mdi-label",
  shift: "mdi-calendar",
  user: "mdi-account",
  home: "mdi-home",
  add: "mdi-plus",
  delete: "mdi-delete-outline",
};
export default {
  props: {
    value: {
      type: String,
      validator: (v) => v in ICONS,
    },
  },

  computed: {
    icon() {
      return ICONS[this.value];
    },
  },
};
</script>