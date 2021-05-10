 <template>
  <v-card>
    <header-layout />
    <messages />
    <slot></slot>
    <v-footer> </v-footer>
  </v-card>
</template>
<script>
import Messages from "../util/Messages.vue";
import HeaderLayout from "./HeaderLayout.vue";

export default {
  components: { Messages, HeaderLayout },
};
</script>