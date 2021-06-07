<template >
  <i-container>
    <i-form>
      <i-calendar
        type="week"
        :value="now"
        :events="events"
        @input="onChange"
        label="Etiquetas"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import { DateTime } from 'luxon';
export default {
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  computed: {
    ...mapGetters("shifts", []),
    now: () => DateTime.now().toISODate(),
    events: () => [],
  },
  methods: {
    ...mapActions("shifts", []),
    ...mapActions("messages", ["handleError"]),

    onChange(events) {
      //todo
    },
    onSubmit() {
      this.$emit("submit");
    },
  },
};
</script>