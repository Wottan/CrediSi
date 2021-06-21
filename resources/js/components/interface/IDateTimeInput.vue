<template>
  <v-row>
    <v-date-picker
      :value="date"
      @input="$emit('inputDate', $event)"
    ></v-date-picker>
    <i-spacer />
    <i-clock-input
      :value="time"
      @input="$emit('inputTime', $event)"
      :format="format"
    ></i-clock-input>
  </v-row>
</template>
<script>
export default {
  data() {
    return {};
  },
  props: {
    date: {
      type: String,
      default: () => null,
    },
    time: {
      type: String,
      default: () => null,
    },
    format: {
      type: String,
      default: () => "ampm",
    },
  },
};
</script>