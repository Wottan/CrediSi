<template >
  <i-dialog :value="true" @close="$emit('close')" width="300">
      <shift-delete-form :value="value" @submit="$emit('delete')" @close="$emit('close')"/>
  </i-dialog>
</template>
<script>
import ShiftDeleteForm from "../forms/ShiftDeleteForm.vue";

export default {
  components: { ShiftDeleteForm },
  props: {
    value: {
      type: Object
    },
  }
};
</script>
