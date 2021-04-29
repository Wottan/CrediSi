import Vue from 'vue'
import router from './router';
import App from './App';
import axios from 'axios';
import VueAxios from 'vue-axios';
import vuetify from './plugins/vuetify';
import Vuelidate from 'vuelidate';


Vue.use(Vuelidate);
Vue.use(VueAxios, axios);

const app = new Vue({
    router,
    vuetify,
    el: '#app',
    render: h => h(App)
});

