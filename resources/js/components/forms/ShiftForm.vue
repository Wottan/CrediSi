<template >
  <i-div>
    <i-form>
      <i-grid>
        <i-grid-row>
          <i-grid-column>
            <user-selector
              :value="shift.user"
              @input="shift.user = $event"
              label="Usuario"
            />
          </i-grid-column>
          <i-grid-column>
            <i-date-input
              :value="shift.start"
              @input="shift.start = $event"
              label="Inicio"
            />
          </i-grid-column>
        </i-grid-row>
      </i-grid>
      <i-calendar
        type="week"
        :events="shift.events"
        @input="shift.events = $event"
        label="Etiquetas"
      />
    </i-form>
    <i-spacer />
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-div>
</template>
<script>
import { mapActions } from "vuex";
import { cloneDeep } from "lodash";
import UserSelector from "../selectors/UserSelector.vue";

export default {
  components: {
    UserSelector,
  },
  props: {
    value: {
      type: Object
    }
  },
  data() {
    return {
      shift: this.value ? cloneDeep(this.value) : { user: {}, events: [], start: null }
    };
  },
  methods: {
    ...mapActions("shifts", ["add","update"]),
    ...mapActions("messages", ["handleError"]),
    onSubmit() {
      let submit = this.value ? this.add : this.update
      submit(this.shift).then(() => {
        this.$emit("submit");
      }).catch(this.handleError);
    },
  },
};
</script>