<template>
  <v-card class="mx-auto my-12" max-width="450" elevation="15">
    <v-card-text>
      <form>
        <v-text-field
          v-model="email"
          :error-messages="emailErrors"
          label="E-mail"
          required
        ></v-text-field>

        <v-text-field
          v-model="password"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :error-messages="passwordErrors"
          label="Password"
          required
          :type="showPassword ? 'text' : 'password'"
          counter
          @click:append="showPassword = !showPassword"
        ></v-text-field>

        <v-btn class="mr-4" @click="submit"> Iniciar sesion </v-btn>
      </form>
    </v-card-text>
  </v-card>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, email } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  validations: {
    password: { required },
    email: { required, email },
  },

  data: () => ({
    showPassword: false,
    password: "",
    email: "",
  }),

  computed: {
    passwordErrors() {
      const errors = [];
      if (!this.$v.password.$dirty) {
        return errors;
      }
      !this.$v.password.required && errors.push("Password es necesario.");
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) {
        return errors;
      }
      !this.$v.email.email && errors.push("El e-mail debe ser valido");
      !this.$v.email.required && errors.push("E-mail es necesario");
      return errors;
    },
  },

  methods: {
    submit() {
      this.$v.$touch();
      this.axios.post("/api/login", {
        email: this.email,
        password: this.password,
      });
    },
  },
};
</script>

