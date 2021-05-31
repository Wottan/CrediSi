<template>
  <i-container>
    <template v-if="user"> Informacion del usuario {{ user.name }} </template>
    <template v-else> No hay usuario disponible </template>
  </i-container>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
    },
  },
};
</script>