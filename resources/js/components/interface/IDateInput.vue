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
    <template v-slot:activator="{ on }">
      <v-text-field
        :value="formatted"
        :label="label"
        :prepend-icon="icon ? 'mdi-calendar': ''"
        :error-messages="errors"
        readonly
        v-on="on"
      />
    </template>
    <v-date-picker :value="iso" @input="onInput" />
  </v-menu>
</template>

<script>
import { DateFunctions } from "../../dates";

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
    icon: {
      type: Boolean,
    },
    errors: {
      type: Array,
    },
  },
  computed: {
    formatted() {
      return DateFunctions.fromISOToDateUserStr(this.value);
    },
    iso() {
      return DateFunctions.fromISOToDateStr(this.value);
    }
  },
  methods: {
    onInput(value) {
      this.show = false;
      this.$emit("input", value);
    },
  },
};
</script>

