<template>
  <i-div wide>{{ formatted }}</i-div>
</template>

<script>
import { DateFunctions } from "../../dates";

export default {
  computed: {
    formatted() {
      return DateFunctions.fromISOToDateUserStr(this.value);
    },
  },
  props: {
    value: {
      type: String,
    },
  },
};
</script>



