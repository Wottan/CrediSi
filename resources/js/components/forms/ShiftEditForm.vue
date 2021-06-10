<template >
  <i-container>
    <i-form>
      <i-calendar
        type="week"
        :value="now"
        :events="events"
        @input="events = $event"
        label="Etiquetas"
      />  
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-container>
</template>
<script>
import { cloneDeep } from "lodash";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      shift: cloneDeep(this.value),
    };
  },
  props: {
    value: {
      type: Object,
      required: true,
    },
  },
  methods: {
    ...mapActions("shifts", ["update"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      this.update(this.shift)
        .then(() => {
          this.$emit("submit");
        })
        .catch(this.handleError);
    },
  },
};
</script>