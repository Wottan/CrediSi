<template>
  <div class="form-container">
    <label> Email: <input type="email" v-model="email" /> </label>
    <label> Password: <input type="password" v-model="password" /> </label>

    <button @click="submit">Iniciar sesión</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
    };
  },
  methods: {
    submit() {
      console.debug("submit", this.email, this.password);
      this.axios.post("/api/login", {
        email: this.email,
        password: this.password,
      });
    },
  },
};
</script>

