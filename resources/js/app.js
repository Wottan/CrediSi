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
import IButtonIcon from './components/interface/IButtonIcon';
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
import IChip from './components/interface/IChip';
import ICardText from './components/interface/ICardText';
import IComboBoxInput from './components/interface/IComboBoxInput';
import ICalendarInput from './components/interface/ICalendarInput';
import IFilterableSelect from './components/interface/IFilterableSelect';
import IDateInput from './components/interface/IDateInput';
import ISelect from './components/interface/ISelect';
import IDate from './components/interface/IDate';
import IImage from './components/interface/IImage';
import IClockInput from './components/interface/IClockInput';
import ITimeInput from './components/interface/ITimeInput';
import IDateTimeInput from './components/interface/IDateTimeInput';
import IColorInput from './components/interface/IColorInput';
import IEmailInput from './components/interface/IEmailInput';
import ICheckboxInput from './components/interface/ICheckboxInput';
import IText from './components/interface/IText'

Vue.use(Vuelidate);
Vue.use(VueAxios, axios);

//Interface Vocabulary
Vue.component('i-snackbar', ISnackbar);
Vue.component('i-button', IButton);
Vue.component('i-button-icon', IButtonIcon);
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
Vue.component('i-calendar-input', ICalendarInput);
Vue.component('i-filterable-select', IFilterableSelect);
Vue.component('i-div', IDiv);
Vue.component('i-date-input', IDateInput);
Vue.component('i-chip', IChip);
Vue.component('i-select', ISelect);
Vue.component('i-date', IDate);
Vue.component('i-image', IImage);
Vue.component('i-time-input', ITimeInput);
Vue.component('i-clock-input', IClockInput);
Vue.component('i-date-time-input', IDateTimeInput);
Vue.component('i-color-input', IColorInput);
Vue.component('i-email-input', IEmailInput);
Vue.component('i-checkbox-input', ICheckboxInput);
Vue.component('i-text', IText);

const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});