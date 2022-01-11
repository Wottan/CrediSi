<template >
  <i-container>
    <i-form>
      <i-text-input
        :value="abonado.name"
        @input="abonado.name = $event"
        label="Nombre"
      />
      <i-text-input
        :value="abonado.last_name"
        @input="abonado.last_name = $event"
        label="Apellido"
      />
      <i-date-input
        :value="abonado.date_of_birth"
        @input="abonado.date_of_birth = $event"
        label="Fecha nacimiento"
      />
      <i-text-input
        :value="abonado.sex"
        @input="abonado.sex = $event"
        label="Sexo"
      />
      <i-date-input
        :value="abonado.start_date"
        @input="abonado.start_date = $event"
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

export default {
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
    onSubmit() {
      let submit = this.value ? this.update : this.add;
      submit(this.abonado)
        .then(() => {
          this.$emit("submit");
        })
        .catch(this.handleError);
    },

    init() {
      if (this.value) {
        this.abonado = cloneDeep(this.value);
      } else {
        this.abonado = {
          date_of_birth: null,
          start_date: null,
        };
      }
    },
  },
};
</script>