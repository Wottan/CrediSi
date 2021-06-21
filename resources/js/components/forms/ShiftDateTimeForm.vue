<template >
  <v-card-text>
    <i-form>
      <i-date-time-input
        :date="date"
        :time="time"
        @inputDate="date = $event"
        @inputTime="time = $event"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Aceptar </i-button>
  </v-card-text>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      time: null,
      date: null,
    };
  },
  props: {
    value: {
      type: Object,
    },
  },
  methods: {
    ...mapActions("shifts", ["filterByDateTime"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.filterByDateTime(this.date + this.time)
        .then(() => {
          this.$emit("submit");
        })
        .catch(this.handleError);
    },
  },
};
</script>