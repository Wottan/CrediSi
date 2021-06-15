<template>
  <v-icon
    :x-small="'tiny' === size"
    :small="'small' === size"
    :large="'large' === size"
    >{{ icon }}</v-icon
  >
</template>
<script>
const ICONS = {
  login: "mdi-login",
  logout: "mdi-logout",
  edit: "mdi-pencil",
  label: "mdi-label",
  shift: "mdi-calendar-clock",
  timeoff: "mdi-calendar-remove",
  user: "mdi-account",
  home: "mdi-home",
  add: "mdi-plus",
  delete: "mdi-delete-outline",
  close: "mdi-close",
};
export default {
  props: {
    value: {
      type: String,
      validator: (v) => v in ICONS,
    },
    size: {
      type: String,
      default: "normal",
      validator: (v) => ["tiny", "small", "normal", "large"].includes(v),
    },
  },

  computed: {
    icon() {
      return ICONS[this.value];
    },
  },
};
</script>