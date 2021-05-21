<template>
  <page-layout>
    <user-table />
  </page-layout>
</template>
<script>
import PageLayout from "../layout/PageLayout.vue";
import UserTable from "../users/UserTable.vue";
export default {
  components: { PageLayout, UserTable },
};
</script>
