<template >
  <i-dialog :value="true" @close="close" width="900">
    <v-card>
      <v-card-title> {{ value.name }} </v-card-title>
      <i-calendar-input readonly type="week" :events="events" />
    </v-card>
  </i-dialog>
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
  computed: {
    ...mapGetters("shifts", ["shifts"]),
    events() {
      return this.shifts.filter(s => s.user_id === this.value.id).flatMap(s => s.events) || [];
    },
  },
  created() {
    this.load();
  },
  methods: {
    ...mapActions("shifts", ["load"]),
    close() {
      this.$emit("close");
    },
  },
};
</script>
