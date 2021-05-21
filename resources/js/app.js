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
import ICard from './components/interface/ICard';
import IApp from './components/interface/IApp';
import IMessages from './components/interface/IMessages';
import IContainer from './components/interface/IContainer';
import ISpacer from './components/interface/ISpacer';
import IGrid from './components/interface/IGrid';
import IGridRow from './components/interface/IGridRow';
import IGridColumn from './components/interface/IGridColumn';
import IAppBar from './components/interface/IAppBar';
import IFooter from './components/interface/IFooter';

Vue.use(Vuelidate);
Vue.use(VueAxios, axios);

//Interface Vocabulary
Vue.component('i-snackbar', ISnackbar);
Vue.component('i-button', IButton);
Vue.component('i-table', ITable);
Vue.component('i-card', ICard);
Vue.component('i-app', IApp);
Vue.component('i-messages', IMessages);
Vue.component('i-container', IContainer);
Vue.component('i-spacer', ISpacer);
Vue.component('i-grid', IGrid);
Vue.component('i-grid-row', IGridRow);
Vue.component('i-grid-column', IGridColumn);
Vue.component('i-app-bar', IAppBar);
Vue.component('i-footer', IFooter);


const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});

