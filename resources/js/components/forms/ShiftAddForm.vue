<template >
  <i-container>
    <i-form>
      <user-selector :value="shift.user" @input="shift.user = $event" />
      <i-calendar
        type="week"
        :events="shift.events"
        @input="shift.events = $event"
        label="Etiquetas"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-container>
</template>
<script>
import { mapActions } from "vuex";
import UserSelector from "../selectors/UserSelector.vue";

export default {
  components: {
    UserSelector,
  },
  data() {
    return {
      shift: {user: {}, events: []},
    };
  },
  methods: {
    ...mapActions("shifts", ["add"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.add(this.shift)
        .then(() => {
          this.$emit("submit");
        })
        .catch(this.handleError);
    },
  },
};
</script>