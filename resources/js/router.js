import Vue from 'vue';
import VueRouter from 'vue-router';

import LoginPage from './components/pages/LoginPage.vue';
import HomePage from './components/pages/HomePage.vue';
import ShiftsPage from './components/pages/ShiftsPage.vue';
import LabelsPage from './components/pages/LabelsPage.vue';
import TimeoffPage from './components/pages/TimeoffPage.vue';
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