<template >
  <i-dialog :value="show" @close="close" width="900">
    <v-card>
      <v-card-title> {{ value.name }} </v-card-title>
      <user-shifts-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import UserShiftsForm from "../forms/UserShiftsForm.vue";
export default {
  components: { UserShiftsForm },
  props: {
    show: {
      type: Boolean,
      required: true,
    },
    value: {
      type: Object,
      required: true,
    },
  },

  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
