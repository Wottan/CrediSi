<template >
  <i-dialog :value="true" @close="close" width="500">
    <v-card>
      <v-card-title> {{ value.name }} </v-card-title>
      <shift-label-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import ShiftLabelForm from "../forms/ShiftLabelForm.vue";
export default {
  components: { ShiftLabelForm },
  props: {
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
