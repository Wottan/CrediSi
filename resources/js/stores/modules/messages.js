import { isEqual } from 'lodash';

/**
 * Valid types of messages
 */
const Types = {
    INFO: 'info',
    SUCESS: 'success',
    WARN: 'warning',
    ERROR: 'error',
}

/**
 * Maps rest response
 * @param {*} response 
 * @returns { status, message, error }
 */
function RestResponse(response) {

    if (!response.status) {
        throw Error("Not a rest response");
    }
    return {
        status: response.status,
        message: response.data?.message || response.statusText,
        error: response.data?.error,
    }
}

/**
 * Creates a Message from Rest response
 * 
 * @returns { text, type, timeout }
 */
function RestResponseMessage(restResponse, type, timeout) {
    let r = RestResponse(restResponse);
    return Message(r.error || r.message, type, timeout);
}

/**
 * Creates a Message
 * 
 * @returns { text, type, timeout }
 */
function Message(text, type, timeout) {
    if (!Object.values(Types).includes(type)) {
        throw Error("Not a valid type: " + type);
    }
    return { text, type, timeout };
}

export default {
    namespaced: true,

    state: {
        messages: [],
    },

    getters: {
        messages: state => state.messages,
    },

    actions: {
        handleError({ commit }, response) {
            commit("add", RestResponseMessage(response, Types.ERROR, 0));
        },
        handleSuccess({ commit }, response) {
            commit("add", RestResponseMessage(response, Types.SUCESS, 10));
        },
        warn({ commit }, text) {
            commit("add", Message(text, Types.WARN, 10));
        },
        info({ commit }, text) {
            commit("add", Message(text, Types.INFO, 10));
        },
        remove({ commit }, message) {
            commit("remove", message);
        },
        clear({ commit }) {
            commit("clear");
        },
    },

    mutations: {
        remove(state, message) {
            state.messages = state.messages.filter(m => !isEqual(m, message));
        },
        add(state, message) {
            state.messages = state.messages.filter(m => !isEqual(m, message));
            state.messages.push(message);
        },
        clear(state) {
            state.messages = [];
        },
    }
}