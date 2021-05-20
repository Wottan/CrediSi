<template>
  <i-table :headers="headers" :items="users" :title="'Usuarios'"></i-table>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      headers: [
        { text: "Id", value: "id" },
        { text: "Nombre", value: "name" },
        { text: "Email", value: "email" },
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