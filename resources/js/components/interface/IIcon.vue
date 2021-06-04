<template>
  <v-icon>{{ icon }}</v-icon>
</template>
<script>
const ICONS = {
  login: "mdi-login",
  logout: "mdi-logout",
  edit: "mdi-pencil",
  label: "mdi-label",
};
export default {
  props: {
    value: {
      type: String,
      validator: (value) => {
        return value in ICONS;
      },
    },
  },

  computed: {
    icon() {
      return ICONS[this.value];
    },
  },
};
</script>