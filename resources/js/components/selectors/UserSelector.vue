<template>
  <i-filterable-select
    :value="selected"
    :options="options"
    :label="label"
    @input="onInput"
  />
</template>

<script>
import { cloneDeep } from "lodash";
import { mapActions, mapGetters } from "vuex";

export default {
  props: {
    value: {
      type: Object,
      default: () => ({}),
    },
    label: {
      type: String,
    },
  },
  computed: {
    ...mapGetters("users", ["users"]),
    options() {
      return this.users.map((u) => ({ value: u.id, label: u.name }));
    },
    selected() {
      return { value: this.value.id, label: this.value.name };
    },
  },
  methods: {
    ...mapActions("users", ["load"]),
    onInput(id) {
      this.$emit("input", cloneDeep(this.users.find((u) => (u.id = id))));
    },
  },
  created() {
    this.load();
  },
};
</script>