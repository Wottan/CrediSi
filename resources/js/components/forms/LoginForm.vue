<template>
  <i-form>
    <i-text-input
      :value="email"
      :errors="emailErrors"
      label="E-mail"
      @input="email = $event"
    ></i-text-input>

    <i-password-input
      :value="password"
      :errors="passwordErrors"
      label="Password"
      @input="password = $event"
    ></i-password-input>

    <i-button @click="submit"> Iniciar sesion </i-button>

    <i-button href="/auth/redirect"> Iniciar sesion con Google </i-button>
  </i-form>
</template>
<script>
import { validationMixin } from "vuelidate";
import { required, email } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
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
      let errors = [];
      this.$v.password.$dirty &&
        !this.$v.password.required &&
        errors.push("Password es necesario.");
      return errors;
    },
    emailErrors() {
      let errors = [];
      !this.$v.email.email && errors.push("El e-mail debe ser valido");
      this.$v.email.$dirty &&
        !this.$v.email.required &&
        errors.push("E-mail es necesario");
      return errors;
    },
  },

  methods: {
    ...mapActions("auth", ["login"]),
    ...mapActions("messages", ["handleError"]),
    submit() {
      this.$v.$touch();
      this.login({
        email: this.email,
        password: this.password,
      })
        .then(() => {
          this.$router.push({ name: "home" });
        })
        .catch(this.handleError);
    },
  },
};
</script>
