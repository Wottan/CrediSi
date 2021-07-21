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
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      localeLabels: this.value.labels.map((obj) => {
        return { id: obj.id, text: obj.text, color: obj.color };
      }),
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
      return this.value.labels;
    },
  },
  methods: {
    ...mapActions("labels", ["load", "upsert"]),
    ...mapActions("shifts", ["syncLabels"]),
    ...mapActions("messages", ["handleError"]),

    onSelectedLabelsChange(labels) {
      //to do translate to objects
      this.localeLabels = [];
      labels.forEach((element) => {
        if (typeof element === "string") {
          this.localeLabels.push({ text: element, color: "" });
        } else {
          this.localeLabels.push({ text: element.text, color: element.color });
        }
      });
    },

    onSubmit() {
      this.upsert(this.localeLabels)
        .then((labels) => {
          let labelIds = this.localeLabels.map((l) => {
            return labels.find((e) => e.text === l.text)?.id;
          });

          this.syncLabels({ labelIds: labelIds, idShift: this.value.id }).then(
            () => {
              this.$emit("submit");
            }
          );
        })
        .catch(this.handleError);
    },
  },
  created() {
    this.load();
  },
};
</script>