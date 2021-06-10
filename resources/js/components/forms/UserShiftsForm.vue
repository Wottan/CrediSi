<template >
    <i-form>
      <i-calendar
        type="week"
        :events="events"
        @input="events = $event"
        label="Etiquetas"
      />
      <i-button @click="onSubmit"> Guardar </i-button>
    </i-form>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    events: []
  }),
  computed: {
    ...mapGetters("shifts", []),
  },
  methods: {
    ...mapActions("shifts", []),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.$emit("submit");
    },
  },
};
</script>