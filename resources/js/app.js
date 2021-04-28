import Vue from 'vue'
import router from './router';
import App from './App';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});

