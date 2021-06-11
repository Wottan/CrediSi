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
      label: this.value.labels.map((obj) => {
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
    ...mapActions("users", ["updateLabel"]),
    ...mapActions("messages", ["handleError"]),

    onSelectedLabelsChange(labels) {
      //to do translate to objects
      this.label = [];
      labels.forEach((element) => {
        if (typeof element === "string") {
          this.label.push({ text: element, color: "" });
        } else {
          this.label.push({ text: element.text, color: element.color });
        }
      });
    },

    onSubmit() {
      this.upsert(this.label).then((r) => {
        let labelIds = this.label.map((l) => {
          return r.data.find((e) => e.text === l.text)?.id;
        });

        this.updateLabel({ labelIds: labelIds, idUser: this.value.id }).then(
          () => {
            this.$emit("submit");
          }
        );
      });
    },
  },

  created() {
    this.load();
  },
};
</script>
