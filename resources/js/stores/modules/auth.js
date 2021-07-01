import axios from 'axios';

export default {
    namespaced: true,

    state: {
        user: {},
        login: false,
    },
    actions: {
        check({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get("/login/check")
                .then((result) => {
                    commit("login", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                axios.post("/api/login", credentials
                ).then((result) => {
                    commit("login", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios.post("/api/logout"
                ).then((result) => {
                    commit("logout", {});
                    resolve(result);
                }).catch(err => {
                    reject(err);
                })
            });
        }
    },

    mutations: {
        login(state, user) {
            state.user = user;
            state.login = true
        },
        logout(state, user) {
            state.user = user;
            state.login = false
        },
    }
}