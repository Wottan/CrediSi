import Vue from 'vue';
import VueRouter from 'vue-router';

import HomePage from './components/pages/HomePage.vue';
import store from './stores/store'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: HomePage
        },
        {
            path: '*',
            redirect: '/home'
        },
    ]
});

router.beforeEach((to, from, next) => {
    store.dispatch("messages/clear");
    next();
});

export default router;