<template>
  <v-menu
    :value="show"
    @input="show = $event"
    :close-on-content-click="false"
    :nudge-right="40"
    transition="scale-transition"
    offset-y
    min-width="auto"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
        :value="value"
        @input="$emit('input', $event)"
        :label="label"
        prepend-icon="mdi-calendar"
        readonly
        v-bind="attrs"
        v-on="on"
      ></v-text-field>
    </template>
    <v-date-picker :value="value" @input="onInput"></v-date-picker>
  </v-menu>
</template>

<script>
export default {
  data: () => ({
    show: false,
  }),
  props: {
    value: {
      type: String,
    },
    label: {
      type: String,
    },
  },
  methods: {
    onInput(value) {
      this.show = false;
      this.$emit("input", value);
    },
  },
};
</script>

