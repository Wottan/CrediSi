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
        :value="value"
        :label="label"
        prepend-icon="mdi-clock"
        readonly
        v-on="on"
      />
    </template>
    <v-time-picker
      :value="value"
      @input="onInput"
      scrollable
      :format="format"
    />
  </v-menu>
</template>
<script>
export default {
  data() {
    return {
      show: false,
    };
  },
  props: {
    value: {
      type: String,
      default: () => null,
    },
    format: {
      type: String,
      default: () => "ampm",
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