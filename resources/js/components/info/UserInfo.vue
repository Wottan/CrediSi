<template>
  <i-div wide>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column :cols="4">
          <i-card-text> <i-text bold>Nombre:</i-text> {{ value.name }} </i-card-text>
          <i-card-text> <i-text bold>Etiquetas: </i-text> <labels-info :value="value.labels" /></i-card-text>
        </i-grid-column>
        <i-grid-column :cols="4">
          <i-card-text> <i-text bold>Ingreso: </i-text><i-date :value="value.admission_date"/></i-card-text>
          <i-card-text> <i-text bold>Telefono: </i-text>{{ value.phone }} </i-card-text>
          <i-card-text> <i-text bold>Correo: </i-text>{{ value.email }} </i-card-text>
        </i-grid-column>
        <i-grid-column :cols="4">
          <i-card-text> <i-text bold>Es admininstrador: </i-text>{{ value.is_admin ? "Si" : "No" }} </i-card-text>
          <i-card-text> <i-text bold>Puede iniciar sesión: </i-text>{{ value.can_login ? "Si" : "No" }} </i-card-text>
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