<template>
  <i-filterable-select
    :value="selected"
    :options="options"
    :label="label"
    @input="onInput"
  />
</template>

<script>
export default {
  data: () => ({}),

  props: {
    value: {
      type: String,
      default: () => "",
    },
    label: {
      type: String,
    },
  },

  computed: {
    options() {
      return ["Masculino", "Femenino"];
    },
    selected() {
      return { value: this.value };
    },
  },
  methods: {
    onInput(id) {
      this.$emit("input", id);
    },
  },
};
</script>