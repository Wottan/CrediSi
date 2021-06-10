<template >
    <i-form>
      <i-calendar
        type="week"
        :value="now"
        :events="events"
        @input="events = $event"
        label="Etiquetas"
      />
      <i-button @click="onSubmit"> Guardar </i-button>
    </i-form>
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
  data: () => ({
    events: []
  }),
  computed: {
    ...mapGetters("shifts", []),
    now: () => DateTime.now().toISODate(),
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