<template>
  <layout>
    <user-table />
  </layout>
</template>
<script>
import Layout from "../layout/Layout.vue";
import UserTable from "../users/UserTable.vue";
export default {
  components: { Layout, UserTable },
};
</script>
