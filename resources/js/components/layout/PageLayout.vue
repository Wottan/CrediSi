 <template>
  <i-card>
    <header-layout />
    <slot></slot>
    <footer-layout />
  </i-card>
</template>
<script>
import HeaderLayout from "./HeaderLayout.vue";
import FooterLayout from "./FooterLayout.vue";

export default {
  components: { 
    HeaderLayout,
    FooterLayout
  },
};
</script>