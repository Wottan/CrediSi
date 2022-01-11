<template>
  <i-container>
    <i-table
      :columns="columns"
      :sort-by="['user.name']"
      :rows="timeoffList"
      title="Inasistencias"
      :loading="loading"
    >
      <template v-slot:tableActions>
        <i-spacer />
        <create-timeoff-action />
      </template>
      <template v-slot:rowActions="{ row }">
        <timeoff-actions :value="row" />
      </template>
      <template v-slot:start="{ row }">
        {{ format(row.start) }}
      </template>
    </i-table>
  </i-container>
</template>
<script>
import { mapActions, mapState } from "vuex";
import { DateFunctions } from "../../dates";
import CreateTimeoffAction from "../actions/CreateTimeoffAction.vue";
import TimeoffActions from "../actions/TimeoffActions.vue";

export default {
  components: {
    TimeoffActions,
    CreateTimeoffAction,
  },
  data() {
    return {
      columns: [
        {
          text: "Usuario",
          value: "user.name",
        },
        {
          text: "Inicio",
          value: "start",
        },
        {
          text: "Tipo",
          value: "type",
        },
      ],
      loading: false,
    };
  },
  computed: {
    ...mapState("timeoff", ["timeoffList"]),
  },

  methods: {
    ...mapActions("timeoff", ["load"]),
    format(dateTime) {
      return DateFunctions.fromISOToDateUserStr(dateTime);
    },
  },

  created() {
    this.loading = true;
    console.debug(this.loading);
    this.load().finally(() => (this.loading = false));
  },
};
</script>