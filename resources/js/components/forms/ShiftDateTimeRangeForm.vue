<template >
  <i-container>
    <i-form>
      <v-card-text>
        <v-card-title>Desde</v-card-title>
        <i-grid-row>
          <i-date-input
            label="Fecha desde"
            :value="dateStart"
            @input="dateStart = $event"
          />
          <i-time-menu-input
            :value="timeStart"
            @input="timeStart = $event"
            label="Hora desde"
          />
        </i-grid-row>
      </v-card-text>
      <v-card-text>
        <v-card-title>Hasta</v-card-title>
        <i-grid-row>
          <i-date-input
            label="Fecha hasta"
            :value="dateEnd"
            @input="dateEnd = $event"
          />
          <i-time-menu-input
            :value="timeEnd"
            @input="timeEnd = $event"
            label="Hora hasta"
          />
        </i-grid-row>
      </v-card-text>
    </i-form>
    <i-button @click="onSubmit"> Aceptar </i-button>
  </i-container>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      timeStart: null,
      dateStart: null,
      timeEnd: null,
      dateEnd: null,
    };
  },
  props: {
    value: {
      type: Object,
    },
  },
  methods: {
    ...mapActions("shifts", ["byDateTime"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.$emit("submit");
    },
  },
};
</script>