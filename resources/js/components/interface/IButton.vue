<template >
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        @click="$emit('click')"
        :color="color"
        v-bind="attrs"
        v-on="on"
        :href="href"
      >
        <slot />
      </v-btn>
    </template>
    {{ tooltip }}
  </v-tooltip>
</template>
<script>
export default {
  props: {
    tooltip: {
      type: String,
    },
    color: {
      type: String,
    },
    href: {
      type: String,
    },
  },
};
</script>