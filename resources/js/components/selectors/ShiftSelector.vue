<template>
  <i-select :options="options" :label="label" @input="$emit('input', $event)" />
</template>
<script>
export default {
  data() {
    return {
      options: [
        { value: 1, text: "todos" },
        { value: 2, text: "hoy" },
        { value: 3, text: "activos" },
      ],
    };
  },
  props: {
    label: {
      type: String,
    },
  },
};
</script>