import Vue from 'vue'
import router from './router';
import App from './components/App';
import axios from 'axios';
import VueAxios from 'vue-axios';
import vuetify from './plugins/vuetify';
import Vuelidate from 'vuelidate';
import store from './stores/store';

Vue.use(Vuelidate);
Vue.use(VueAxios, axios);

const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});

