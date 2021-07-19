<template>
  <i-form>
    <i-table :columns="columns" :rows="proxies" :sort-by="['text']" title="Etiquetas" :loading="loading">
      <template v-slot:tableActions>
        <i-text-input :value="newLabel" @input="newLabel = $event" />
        <i-button-icon
          value="add"
          tooltip="Crear etiqueta"
          @click="onAdd"
          :disabled="!newLabel"
        />
      </template>
      <template v-slot:text="{ row }">
        <i-text-input :value="row.text" @input="row.text = $event" />
      </template>
      <template v-slot:color="{ row }">
        <i-color-input :value="row.color" @input="row.color = $event" />
      </template>
      <template v-slot:rowActions="{ row }">
        <i-button-icon
          value="delete"
          tooltip="Eliminar etiqueta"
          @confirm="onDelete(row)"
        />
      </template>
    </i-table>
    <i-button @click="onSubmit"> Guardar </i-button>
  </i-form>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import { cloneDeep } from "lodash";

export default {
  data() {
    return {
      columns: [
        { text: "Texto", value: "text" },
        { text: "Color", value: "color" },
      ],
      proxies: [],
      newLabel: null,
      loading: false
    };
  },
  computed: {
    ...mapGetters("labels", ["labels"]),
  },
  methods: {
    ...mapActions("labels", ["load", "update", "delete", "upsert"]),
    ...mapActions("messages", ["handleSuccess", "handleError"]),
    onSubmit() {
      this.update(this.proxies).then(this.onSuccess).catch(this.handleError);
    },
    onDelete(label) {
      this.delete(label).then(this.onSuccess).catch(this.handleError);
    },
    onSuccess(response) {
      this.proxy();
      this.handleSuccess(response);
    },
    onAdd() {
      this.upsert([{ text: this.newLabel }])
        .then(this.onSuccess)
        .catch(this.handleError);
    },
    proxy() {
      this.proxies = cloneDeep(this.labels);
    },
  },
  created() {
    this.loading = true;
    this.load().then(this.proxy).finally(() => this.loading = false );
  },
};
</script>