<template >
  <span>
    <v-snackbar
      v-for="(msg, index) in messages"
      :key="index"
      :value="true"
      :style="'margin-bottom:' + index * 50"
      @input="remove(msg)"
      :timeout="msg.timeout * 1000"
    >
      {{ msg.type }}: {{ msg.text }}
      <template #action>
        <v-btn @click="remove(msg)"> Close </v-btn>
      </template>
    </v-snackbar>
  </span>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "messages",
  computed: {
    ...mapGetters("messages", ["messages"]),
  },
  methods: {
    ...mapActions("messages", ["remove"]),
  },
};
</script>

