<template >
  <i-dialog :value="true" @close="close" width="900">
    <v-card>
      <v-card-title> {{ value.name }} </v-card-title>
      <i-calendar-input v-if="events" readonly type="week" :events="events" />
      <i-progress v-else />
    </v-card>
  </i-dialog>
</template>
<script>
import { mapActions } from "vuex";
export default {
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      events: null,
    }  
  },
  created() {
    this.forUser(this.value.id).then(shifts => {
      this.events = shifts?.flatMap(s => s.events) || [];
    }).catch(this.handleError);
  },
  methods: {
    ...mapActions("shifts", ["forUser"]),
    ...mapActions("messages", ["handleError"]),
    close() {
      this.$emit("close");
    },
  },
};
</script>
