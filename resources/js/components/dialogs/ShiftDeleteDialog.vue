<template >
  <i-dialog :value="show" @close="$emit('close')" width="300">
      <shift-delete-form :value="value" @submit="$emit('delete')" @close="$emit('close')"/>
  </i-dialog>
</template>
<script>
import ShiftDeleteForm from "../forms/ShiftDeleteForm.vue";

export default {
  components: { ShiftDeleteForm },
  props: {
    show: {
      type: Boolean
    },
    value: {
      type: Object
    },
  }
};
</script>
