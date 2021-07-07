<template >
  <i-div>
    <v-tooltip bottom :disabled="!tooltip">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          icon
          :x-small="'tiny' === size"
          :small="'small' === size"
          :large="'large' === size"
          @click="onClick"
          :color="color"
          v-bind="attrs"
          v-on="on"
          :href="href"
          :disabled="disabled"
        >
          <i-icon :value="value" :size="size" />
        </v-btn>
      </template>
      {{ tooltip }}
    </v-tooltip>
    <i-dialog :value="confirm" @close="onCancel" width="300">
      <v-card>
        <v-card-title> {{ confirmTitle }} </v-card-title>
        <v-card-text> {{ confirmText }} </v-card-text>
        <v-card-actions>
          <i-button @click="onConfirm"> OK </i-button>
          <i-button @click="onCancel"> Cancelar </i-button>
        </v-card-actions>
      </v-card>
    </i-dialog>
  </i-div>
</template>
<script>
export default {
  props: {
    value: {
      type: String,
      required: true,
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
    disabled: {
      type: Boolean,
    },
    size: {
      type: String,
      default: "normal",
      validator: (v) => ["tiny", "small", "normal", "large"].includes(v),
    },
  },
  data() {
    return {
      confirm: false,
    };
  },
  computed: {
    confirmTitle() {
      return this.tooltip ? this.tooltip : "Esta accion no se puede deshacer";
    },
    confirmText() {
      return "Esta seguro de continuar?";
    },
  },
  methods: {
    onClick() {
      if (this.$listeners.confirm) {
        this.confirm = true;
      } else {
        this.$emit("click");
      }
    },
    onCancel() {
      this.confirm = false;
    },
    onConfirm() {
      this.confirm = false;
      this.$emit("confirm");
    },
  },
};
</script>