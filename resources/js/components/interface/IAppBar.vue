<template>
  <i-div>
    <v-app-bar>
      <v-app-bar-nav-icon @click="menu = true" />
      <slot />
    </v-app-bar>
    <v-navigation-drawer
      :value="menu"
      @input="menu = $event"
      absolute
      bottom
      temporary
    >
      <v-list nav dense>
        <v-list-item-group>
          <v-list-item @click="$router.push('home')"> 
            <v-list-item-icon>
              <i-icon value="home" />
            </v-list-item-icon>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item>
          <v-list-item @click="$router.push('shifts')">
            <v-list-item-icon>
              <i-icon value="shift" />
            </v-list-item-icon>
            <v-list-item-title>Turnos</v-list-item-title>
          </v-list-item>
          <v-list-item @click="$router.push('home')">
            <v-list-item-icon>
              <i-icon value="user"/>
            </v-list-item-icon>
            <v-list-item-title>Usuarios</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </i-div>
</template>
<script>
export default {
  data() {
    return {
      menu: false,
    };
  },
};
</script>
