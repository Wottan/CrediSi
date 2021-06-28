<template>
  <i-div wide>
    <i-button :class="style" @click="show = true" :color="value"></i-button>
    <i-dialog :value="show" @close="show = false" width="300" height="500">
      <v-color-picker
        :value="value"
        :label="label"
        @input="onInput"
        :error-messages="errors"
        dot-size="25"
        hide-canvas
        hide-inputs
        hide-mode-switch
        hide-sliders
        show-swatches
        mode="hexa"
      />
    </i-dialog>
  </i-div>
</template>
<script>
export default {
  props: {
    value: {
      type: String,
    },
    label: {
      type: String,
    },
    errors: {
      type: Array,
    },
  },
  data() {
    return {
      show: false,
    };
  },
  computed: {
    style() {
      return {
        backgroundColor: this.value,
        cursor: "pointer",
        height: "30px",
        width: "30px",
      };
    },
  },
  methods: {
    onInput(color) {
      this.show = false;
      this.$emit("input", color.hex || color);
    },
  },
};
</script>