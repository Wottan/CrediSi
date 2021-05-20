<template >
  <span>
    <i-snackbar
      v-for="(msg, index) in messages"
      :key="index"
      :offset="index * 50"
      @close="remove(msg)"
      :timeout="msg.timeout * 1000"
    >
      {{ msg.type }}: {{ msg.text }}
    </i-snackbar>
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

