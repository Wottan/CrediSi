<template >
  <i-container>
    <i-form>
      <i-text-input
        :value="abonado.name"
        @input="abonado.name = $event"
        :errors="getErrors($v.abonado.name)"
        label="Nombre"
      />
      <i-text-input
        :value="abonado.last_name"
        @input="abonado.last_name = $event"
        :errors="getErrors($v.abonado.last_name)"
        label="Apellido"
      />
      <i-text-input
        :value="abonado.dni"
        @input="abonado.dni = $event"
        :errors="getErrors($v.abonado.dni)"
        label="Dni"
      />
      <i-date-input
        :value="abonado.date_of_birth"
        @input="abonado.date_of_birth = $event"
        :errors="getErrors($v.abonado.date_of_birth)"
        label="Fecha nacimiento"
      />
      <province-selector
        :value="abonado.province"
        @input="abonado.province = $event"
        label="Provincia"
      />
      <sex-selector
        :value="abonado.sex"
        @input="abonado.sex = $event"
        label="Sexo"
      />
      <i-date-input
        :value="abonado.start_date"
        @input="abonado.start_date = $event"
        :errors="getErrorsStartDate($v.abonado.start_date)"
        label="Fecha inicio"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-container>
</template>
<script>
import { cloneDeep } from "lodash";
import { mapActions } from "vuex";
import ProvinceSelector from "../selectors/ProvinceSelector.vue";
import SexSelector from "../selectors/SexSelector.vue";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import { DateFunctions } from "../../dates";

export default {
  components: { ProvinceSelector, SexSelector },

  mixins: [validationMixin],
  validations: {
    abonado: {
      name: { required },
      last_name: { required },
      dni: { required },
      date_of_birth: { required },
      start_date: {
        required,
        minValue: (value, { date_of_birth }) =>
          value <= DateFunctions.fromISOToDateStr(new Date().toISOString()) &&
          value > date_of_birth,
      },
    },
  },
  created() {
    this.init();
  },
  data() {
    return {
      abonado: {},
    };
  },
  props: {
    value: {
      type: Object,
    },
  },
  methods: {
    ...mapActions("abonados", ["add", "update"]),
    ...mapActions("messages", ["handleError"]),
    getErrors(attribute) {
      let errors = [];
      attribute.$dirty &&
        !attribute.required &&
        errors.push("Este campo es requerido.");
      return errors;
    },
    getErrorsStartDate(attribute) {
      let errors = [];
      attribute.$dirty &&
        !attribute.minValue &&
        errors.push(
          "Este campo debe ser menor o igual a la fecha actual y mayor a la fecha de nacimiento"
        );

      return errors;
    },
    onSubmit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let submit = this.value ? this.update : this.add;
        this.abonado.province_id = this.abonado.province.id;

        submit(this.abonado)
          .then(() => {
            this.$emit("submit");
          })
          .catch(this.handleError);
      }
    },

    init() {
      if (this.value) {
        this.abonado = cloneDeep(this.value);
      } else {
        this.abonado = {
          name: null,
          last_name: null,
          dni: null,
          date_of_birth: null,
          start_date: null,
          province: {},
        };
      }
    },
  },
};
</script>