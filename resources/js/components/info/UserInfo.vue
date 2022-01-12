<template>
  <i-div wide>
    <i-grid v-if="value">
      <i-grid-row>
        <i-grid-column :cols="2">
          <i-card-text>
            <i-text bold>Nombre:</i-text> {{ value.name }}
          </i-card-text>
          <i-card-text>
            <i-text bold>Apellido: </i-text>{{ value.last_name }}</i-card-text
          >
          <i-card-text>
            <i-text bold>Sexo: </i-text>{{ value.sex }}</i-card-text
          >
          <i-card-text> <i-text bold>Dni: </i-text>{{ value.dni }}</i-card-text>
        </i-grid-column>
        <i-grid-column :cols="2">
          <i-card-text>
            <i-text bold>Fecha nacimiento: </i-text
            ><i-date :value="value.date_of_birth"
          /></i-card-text>
          <i-card-text>
            <i-text bold>Fecha ingreso: </i-text
            ><i-date :value="value.start_date"
          /></i-card-text>
          <i-card-text>
            <i-text bold>Provincia: </i-text>{{ value.province.name }}
          </i-card-text>
        </i-grid-column>
      </i-grid-row>
    </i-grid>
    <i-card-text v-else> No hay usuario disponible </i-card-text>
  </i-div>
</template>

<script>
export default {
  props: {
    value: {
      type: Object,
    },
  },
};
</script>