import Vue from 'vue';
import VueRouter from 'vue-router';

import LoginPage from './components/pages/LoginPage.vue';
import HomePage from './components/pages/HomePage.vue';
import ShiftsPage from './components/pages/ShiftsPage.vue';
import store from './stores/store'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: LoginPage
        },
        {
            path: '/home',
            name: 'home',
            component: HomePage
        },
        {
            path: '/shifts',
            name: 'shifts',
            component: ShiftsPage
        },
    ]
});

router.beforeEach((to, from, next) => {
    store.dispatch("messages/clear");
    next();
});

export default router;