import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './components/pages/Login.vue';

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
    ]
});

export default router;