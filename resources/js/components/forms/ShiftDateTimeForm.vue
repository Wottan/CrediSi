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
import { DateFunctions } from "../../dates";
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
    ...mapActions("shifts", ["active"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      let datetime = DateFunctions.fromISOToDateTimeStr(
        this.date + "T" + this.time
      );
      this.active(datetime)
        .then(() => {
          this.$emit("submit", datetime);
        })
        .catch(this.handleError);
    },
  },
};
</script>