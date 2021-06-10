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
import ICardActions from './components/interface/ICardActions';
import IApp from './components/interface/IApp';
import IMessages from './components/interface/IMessages';
import IContainer from './components/interface/IContainer';
import IDiv from './components/interface/IDiv';
import ISpacer from './components/interface/ISpacer';
import IGrid from './components/interface/IGrid';
import IGridRow from './components/interface/IGridRow';
import IGridColumn from './components/interface/IGridColumn';
import IAppBar from './components/interface/IAppBar';
import IFooter from './components/interface/IFooter';
import IDialog from './components/interface/IDialog'
import IForm from './components/interface/IForm';
import ITextInput from './components/interface/ITextInput';
import IPasswordInput from './components/interface/IPasswordInput';
import IIcon from './components/interface/IIcon';
import ICardText from './components/interface/ICardText';
import IComboBoxInput from './components/interface/IComboBoxInput';
import ICalendar from './components/interface/ICalendar';
import IFilterableSelect from './components/interface/IFilterableSelect';


Vue.use(Vuelidate);
Vue.use(VueAxios, axios);

//Interface Vocabulary
Vue.component('i-snackbar', ISnackbar);
Vue.component('i-button', IButton);
Vue.component('i-table', ITable);
Vue.component('i-card', ICard);
Vue.component('i-card-text', ICardText);
Vue.component('i-card-actions', ICardActions);
Vue.component('i-app', IApp);
Vue.component('i-messages', IMessages);
Vue.component('i-container', IContainer);
Vue.component('i-spacer', ISpacer);
Vue.component('i-grid', IGrid);
Vue.component('i-grid-row', IGridRow);
Vue.component('i-grid-column', IGridColumn);
Vue.component('i-app-bar', IAppBar);
Vue.component('i-footer', IFooter);
Vue.component('i-dialog', IDialog);
Vue.component('i-form', IForm);
Vue.component('i-text-input', ITextInput);
Vue.component('i-password-input', IPasswordInput);
Vue.component('i-icon', IIcon);
Vue.component('i-combo-box-input', IComboBoxInput);
Vue.component('i-calendar', ICalendar);
Vue.component('i-filterable-select', IFilterableSelect);
Vue.component('i-div', IDiv);

const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});

