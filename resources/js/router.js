import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './components/pages/Login.vue';
import Home from './components/pages/Home.vue';
import store from './stores/store'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/home',
            name: 'Home',
            component: Home
        },
    ]
});

router.beforeEach((to, from, next) => {
   store.dispatch("messages/clear");
   next(); 
});

export default router;