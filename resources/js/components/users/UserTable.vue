<template>
  <i-table :columns="columns" :rows="users" :title="'Usuarios'">
    <template v-slot:expandedRow="{ row }">
      <user-info :user="row"/>
    </template>
  </i-table>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import UserInfo from "./UserInfo";
export default {
  components: {
    UserInfo
  },
  data() {
    return {
      columns: [
        { text: "Nombre", value: "name" },
        { text: "Email", value: "email" },
        { text: "", value: "data-table-expand" },
      ],
    };
  },
  computed: {
    ...mapGetters("users", ["users"]),
  },
  methods: {
    ...mapActions("users", ["load"]),
  },
  created() {
    this.load();
  },
};
</script>