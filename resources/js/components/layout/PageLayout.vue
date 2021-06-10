 <template>
  <i-div>
    <header-layout />
    <slot></slot>
    <footer-layout />
  </i-div>
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