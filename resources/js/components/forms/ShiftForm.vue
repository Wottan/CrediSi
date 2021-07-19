<template >
  <i-div wide>
    <i-form v-if="shift">
      <i-grid>
        <i-grid-row>
          <i-grid-column>
            <user-selector
              :value="shift.user"
              @input="shift.user = $event"
              :errors="getErrors($v.shift.user)"
              label="Usuario"
            />
          </i-grid-column>
          <i-grid-column>
            <i-date-input
              :value="shift.start"
              @input="shift.start = $event"
              :errors="getErrors($v.shift.start)"
              label="Inicio"
            />
          </i-grid-column>
          <i-grid-column>
            <i-select-input
              :value="shift.recurrence"
              :options="recurrences"
              @input="shift.recurrence = $event"
              label="Frequencia"
            />
          </i-grid-column>
        </i-grid-row>
      </i-grid>
      <i-calendar-input
        type="week"
        :events="shift.events"
        @input="shift.events = $event"
        label="Etiquetas"
      />
      <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
    </i-form>
    <i-container v-else><i-progress /></i-container>
  </i-div>
</template>
<script>
import { mapActions } from "vuex";
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
      shift: null,
      recurrences: [
        { value: "weekly", text: "Semanal" },
        { value: "biweekly", text: "Cada dos semanas" },
      ],
    };
  },
  mixins: [validationMixin],
  validations: {
    shift: {
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
    ...mapActions("shifts", ["add", "update","editable"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let submit = this.value ? this.update : this.add;
        this.shift.user_id = this.shift.user.id;
        submit(this.shift)
          .then(() => {
            this.$emit("submit");
          })
          .catch(this.handleError);
      }
    },
    init() {
      if (this.value) {
        this.editable(this.value.id).then((shift) => {
          this.shift = shift;          
        }).catch(this.handleError);
      } else {
        this.shift = {
          user: {},
          events: [],
          start: null,
          type: "week",
          recurrence: "weekly",
        };
      }
    },
  },
};
</script>