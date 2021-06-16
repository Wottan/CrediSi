<template >
  <v-tooltip bottom :disabled="!tooltip">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        icon
        :x-small="'tiny'===size"
        :small="'small'===size"
        :large="'large'===size"
        @click="$emit('click')"
        :color="color"
        v-bind="attrs"
        v-on="on"
        :href="href"
      >
        <i-icon :value="value" :size="size"/>
      </v-btn>
    </template>
    {{ tooltip }}
  </v-tooltip>
</template>
<script>
export default {
  props: {
    value: {
      type: String,
      required: true
    },
    tooltip: {
      type: String,
    },
    color: {
      type: String,
    },
    href: {
      type: String,
    },
    size: {
      type: String,
      default: "normal",
      validator: (v) => ['tiny','small','normal','large'].includes(v)
    }
  },
};
</script>