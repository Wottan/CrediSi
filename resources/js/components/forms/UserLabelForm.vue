<template >
  <i-container>
    <i-form>
      <i-combo-box-input
        :options="labels"
        :value="selectedLabels"
        @input="onSelectedLabelsChange"
        label="Etiquetas"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-container>
</template>
<script>
import { cloneDeep } from "lodash";
import { mapActions, mapGetters } from "vuex";
import IComboBox from "../interface/IComboBoxInput.vue";
export default {
  components: { IComboBox },
  data() {
    return {
      label: cloneDeep(this.value),
    };
  },
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  computed: {
    ...mapGetters("labels", ["labels"]),
    selectedLabels() {
      return this.value.labels?.map((l) => l.text);
    },
  },
  methods: {
    ...mapActions("labels", ["load"]),
    ...mapActions("messages", ["handleError"]),

    onSelectedLabelsChange(labels) {
      //to do translate to objects
    },
    onSubmit() {
      this.$emit("submit");
    },
  },
  created() {
    this.load();
  },
};
</script>