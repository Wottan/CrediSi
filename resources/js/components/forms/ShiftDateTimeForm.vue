<template >
  <v-card-text>
    <i-form>
      <i-date-time-input
        :date="date"
        :time="time"
        @inputDate="date = $event"
        @inputTime="time = $event"
        :errors="getErrors($v.date, $v.time)"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Aceptar </i-button>
  </v-card-text>
</template>
<script>
import { mapActions } from "vuex";
import { DateFunctions } from "../../dates";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      time: null,
      date: null,
    };
  },
  mixins: [validationMixin],
  validations: {
    date: { required },
    time: { required },
  },
  props: {
    value: {
      type: Object,
    },
  },
  methods: {
    getErrors(date, time) {
      if((date.$dirty && !date.required) || 
        (time.$dirty && !time.required))
          return "Debe seleccionar fecha y hora.";
    },
    ...mapActions("shifts", ["active"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let datetime = DateFunctions.fromISOToDateTimeStr(
          this.date + "T" + this.time
        );
        this.active(datetime)
          .then(() => {
            this.$emit("submit", datetime);
          })
          .catch(this.handleError);
      }
    },
  },
};
</script>