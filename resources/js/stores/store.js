
import Vue from 'vue';
import Vuex from 'vuex';
import messages from './modules/messages';
import abonados from './modules/abonados';
import provinces from './modules/provinces';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        messages,
        abonados,
        provinces
    },
})