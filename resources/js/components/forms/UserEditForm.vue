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