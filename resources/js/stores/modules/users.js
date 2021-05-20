import axios from 'axios';

export default {
    namespaced: true,

    state: {
        users: [],
    },

    getters: {
        users: state => state.users,
    },

    actions: {
        load({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get("/api/users"
                ).then((result) => {
                    commit("users", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("users", {});
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        users(state, users) {
            state.users = users
        },
    }

}