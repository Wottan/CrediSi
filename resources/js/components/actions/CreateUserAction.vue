<template>
  <i-div>
    <i-form>
      <i-grid-row>
        <i-grid-column cols="11">
          <i-email-input
            :value="email"
            @input="email = $event"
            :errors="emailErrors"
            label="E-mail"
          />
        </i-grid-column>
        <i-grid-column cols="1">
          <i-button-icon value="add" tooltip="Crear usuario" @click="onAdd" />
        </i-grid-column>
      </i-grid-row>
    </i-form>
    <user-edit-dialog
      v-if="showUserEditDialog"
      show
      :value="user"
      @close="showUserEditDialog = false"
    />
  </i-div>
</template>
<script>
import { mapActions } from "vuex";
import { validationMixin } from "vuelidate";
import { required, email } from "vuelidate/lib/validators";
import UserEditDialog from "../dialogs/UserEditDialog.vue";
export default {
  components: { UserEditDialog },
  data() {
    return {
      user: {},
      showUserEditDialog: false,
      email: null,
    };
  },
  mixins: [validationMixin],
  validations: {
    email: { required, email },
  },
  computed: {
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
    ...mapActions("users", ["add"]),
    ...mapActions("messages", ["handleError"]),
    onAdd() {
      this.$v.$touch();
      !this.$v.$invalid &&
        this.add({ email: this.email })
          .then((r) => {
            this.$v.$reset();
            this.user = r.data;
            this.email = null;
            this.showUserEditDialog = true;
          })
          .catch(this.handleError);
    },
  },
};
</script>