
import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import messages from './modules/messages';
import users from './modules/users';
import labels from './modules/labels';
import shifts from './modules/shifts';
import timeoff from './modules/timeoff';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        messages,
        users,
        labels,
        shifts,
        timeoff,
    },
})