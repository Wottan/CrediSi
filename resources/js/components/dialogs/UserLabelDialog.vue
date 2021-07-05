<template >
  <i-dialog :value="true" @close="close" width="500">
    <v-card>
      <v-card-title> {{ value.name }} </v-card-title>
      <user-label-form :value="value" @submit="close" />
    </v-card>
  </i-dialog>
</template>
<script>
import UserLabelForm from "../forms/UserLabelForm.vue";
export default {
  components: { UserLabelForm },
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
