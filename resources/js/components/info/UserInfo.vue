<template>
  <i-div wide>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column align-self="start" :cols="9">
          <i-card-text> Nombre: {{ value.name }} </i-card-text>
          <i-card-text> Etiquetas: <labels-info :value="value.labels" /></i-card-text>
          <i-card-text> Email: {{ value.email }} </i-card-text>
          <i-card-text> Ingreso: <i-date :value="value.admission_date"/></i-card-text>
          <i-card-text> Telefono: {{ value.phone }} </i-card-text>
        </i-grid-column>
      </i-grid-row>
    </i-grid>
    <i-card-text v-else> No hay usuario disponible </i-card-text>
  </i-div>
</template>

<script>
import LabelsInfo from "../info/LabelsInfo.vue";

export default {
  components: {
    LabelsInfo,
  },
  props: {
    value: {
      type: Object,
    },
  },
};
</script>