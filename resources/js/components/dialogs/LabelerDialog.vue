<template >
  <i-dialog :value="true" @close="close" width="500">
    <v-card>
      <v-card-title> {{ value.name }} </v-card-title>
      <labeler-form :value="value" @submit="close" :target="target"/>
    </v-card>
  </i-dialog>
</template>
<script>
import LabelerForm from '../forms/LabelerForm.vue';
export default {
  components: { LabelerForm },
  props: {
    value: {
      type: Object,
      required: true,
    },
    target: {
      type: String,
    },
  },

  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>