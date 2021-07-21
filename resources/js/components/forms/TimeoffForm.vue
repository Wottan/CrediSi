<template >
  <i-div wide>
    <i-form>
      <i-grid>
        <i-grid-row>
          <i-grid-column>
            <user-selector
              :value="timeoff.user"
              @input="timeoff.user = $event"
              :errors="getErrors($v.timeoff.user)"
              label="Usuario"
            />
          </i-grid-column>
          <i-grid-column>
            <i-date-input
              :value="timeoff.start"
              @input="timeoff.start = $event"
              :errors="getErrors($v.timeoff.start)"
              label="Inicio"
            />
          </i-grid-column>
        </i-grid-row>
      </i-grid>

    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-div>
</template>
<script>
import { mapActions } from "vuex";
import { cloneDeep } from "lodash";
import UserSelector from "../selectors/UserSelector.vue";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";

export default {
  components: {
    UserSelector,
  },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      timeoff: {},
    };
  },
  mixins: [validationMixin],
  validations: {
    timeoff: {
      user: { required },
      start: { required },
    },
  },
  created() {
    this.init();
  },
  methods: {
    getErrors(attribute) {
      let errors = [];
      attribute.$dirty &&
        !attribute.required &&
        errors.push("Este campo es requerido.");
      return errors;
    },
    ...mapActions("timeoff", ["add", "update"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let submit = this.value ? this.update : this.add;
        this.timeoff.user_id = this.timeoff.user.id;
        this.timeoff.end = this.timeoff.start; 
        submit(this.timeoff)
          .then(() => {
            this.$emit("submit");
          })
          .catch(this.handleError);
      }
    },
    init() {
      if (this.value) {
        this.timeoff = cloneDeep(this.value);
      } else {
        this.timeoff = {
          user: {},
          start: null,
          type: "Inasistencia",
        };
      }
    },
  },
};
</script>