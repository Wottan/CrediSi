<template>
  <i-grid>
    <i-grid-row>
      <i-grid-column>
        <v-date-picker
          locale="es"
          :value="date"
          @input="$emit('inputDate', $event)"
        ></v-date-picker>
      </i-grid-column>
      <i-grid-column>
        <i-clock-input
          :value="time"
          @input="$emit('inputTime', $event)"
          :format="format"
        ></i-clock-input>
      </i-grid-column>
    </i-grid-row>
    <i-grid-row>
      <i-grid-column align-self="center">
        <i-text color="red" align="center">
          {{ errors }}
        </i-text>
      </i-grid-column>
    </i-grid-row>
  </i-grid>
</template>
<script>
export default {
  props: {
    date: {
      type: String,
    },
    time: {
      type: String,
    },
    format: {
      type: String,
      default: () => "24hr",
    },
    errors: {
      type: String,
    },
  },
};
</script>