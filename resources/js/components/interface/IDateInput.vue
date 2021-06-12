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
        prepend-icon="mdi-calendar"
        readonly
        v-on="on"
      />
    </template>
    <v-date-picker :value="iso" @input="onInput" />
  </v-menu>
</template>

<script>
import { DateTime } from "luxon";

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
  computed: {
    formatted() {
      return this.value && DateTime.fromISO(this.value).toFormat("dd MMM yyyy") || null;
    },
    iso() {
      return this.value && DateTime.fromISO(this.value).toISODate() || null;
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

