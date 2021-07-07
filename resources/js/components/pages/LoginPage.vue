<template>
  <i-card class="mx-auto my-auto">
    <i-image value="logo" />
    <i-card-text>
      <login-form />
    </i-card-text>
  </i-card>
</template>
<script>
import LoginForm from "../forms/LoginForm.vue";

export default {
  components: { LoginForm },
};
</script>
