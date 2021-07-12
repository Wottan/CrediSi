<template >
  <i-container>
    <i-form>
      <i-text-input
        :value="user.name"
        @input="user.name = $event"
        label="Nombre"
      />
      <i-text-input
        :value="user.email"
        @input="user.email = $event"
        label="Email"
      />
      <i-date-input
        :value="user.admission_date"
        @input="user.admission_date = $event"
        label="Ingreso"
      />
      <i-text-input
        :value="user.phone"
        @input="user.phone = $event"
        label="Telefono"
      />
      <i-checkbox-input
        :value="user.is_admin"
        @input="user.is_admin = $event"
        label="Es administrador"
      />
      <i-checkbox-input
        :value="user.can_login"
        @input="user.can_login = $event"
        label="Puede iniciar sesión"
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
  data() {
    return {
      user: cloneDeep(this.value),
    };
  },
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  methods: {
    ...mapActions("users", ["update"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.update(this.user)
        .then(() => {
          this.$emit("submit");
        })
        .catch(this.handleError);
    },
  },
};
</script>