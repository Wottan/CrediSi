<template>
  <v-select
    :items="options"
    :label="label"
    :value="selected"
    item-text="text"
    item-value="value"
    :return-object="false"
    @input="$emit('input', $event)"
  >
    <template v-slot:selection="{ item }" v-if="hasCustomSlot">
      <slot name="selected" :item="item"></slot>
    </template>
  </v-select>
</template>
<script>
export default {
  props: {
    options: Array,
    label: String,
    value: Object | String,
  },
  computed: {
    selected() {
      return typeof this.value === "object" ? this.value : this.options.find(v => v.value === this.value);
    },
    hasCustomSlot() {
      return !!this.$scopedSlots.selected;
    },
    
  }
};
</script>