import Vue from 'vue'
import router from './router';
import App from './components/App';
import axios from 'axios';
import VueAxios from 'vue-axios';
import vuetify from './plugins/vuetify';
import Vuelidate from 'vuelidate';
import store from './stores/store';
import ISnackbar from './components/interface/ISnackbar';
import IButton from './components/interface/IButton';
import ITable from './components/interface/ITable';
import Message from './components/util/Messages';

Vue.use(Vuelidate);
Vue.use(VueAxios, axios);

Vue.component('i-snackbar', ISnackbar);
Vue.component('i-button', IButton);
Vue.component('i-table', ITable);
Vue.component('messages', Message);

const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});

