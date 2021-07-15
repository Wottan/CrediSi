<template >
    <v-snackbar
      :value="true"
      :timeout="timeout"
      :style="'margin-bottom:' + offset"
    >
      <slot></slot>
      <template #action>
        <v-btn @click="$emit('close')"> Cerrar </v-btn>
      </template>
    </v-snackbar>
</template>
<script>
export default {
  name: "snackbar",
  props: {
      timeout: {
          type: Number,
      },
      offset: {
          type: Number,
          default: () => 0
      }
  }
};
</script>

