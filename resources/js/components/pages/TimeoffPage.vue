<template>
  <page-layout>
    <timeoff-table />
  </page-layout>
</template>
<script>
import PageLayout from "../layout/PageLayout.vue";
import TimeoffTable from '../tables/TimeoffTable.vue';
export default {
  components: { PageLayout, TimeoffTable },
};
</script>