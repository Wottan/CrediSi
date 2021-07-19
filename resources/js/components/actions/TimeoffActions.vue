<template>
  <i-div v-if="value" flex>
    <i-button-icon
      value="edit"
      tooltip="Editar"
      @click="showEditDialog = true"
    />
    <timeoff-dialog
      v-if="showEditDialog"
      :value="value"
      @close="showEditDialog = false"
    />

    <i-button-icon
      value="delete"
      tooltip="Eliminar Inasistencia"
      @confirm="onDelete"
    />
  </i-div>
</template>

<script>
import { mapActions } from "vuex";
import TimeoffDialog from "../dialogs/TimeoffDialog.vue";

export default {
  components: {
    TimeoffDialog,
  },
  props: {
    value: {
      type: Object,
    },
  },
  data() {
    return {
      showEditDialog: false,
    };
  },
  methods: {
    ...mapActions("timeoff", ["delete"]),
    ...mapActions("messages", ["handleError"]),
    onDelete() {
      this.delete(this.value)
        .then(() => {
          this.$emit("delete");
        })
        .catch(this.handleError);
    },
  },
};
</script>