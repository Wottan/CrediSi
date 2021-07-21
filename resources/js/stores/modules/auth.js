import http from '../http';

export default {
    namespaced: true,

    state: {
        user: {},
        login: false,
    },
    actions: {
        check({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/login/check")
                .then((result) => {
                    commit("login", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                http.post("/login", credentials
                ).then((result) => {
                    commit("login", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                http.post("/logout"
                ).then((result) => {
                    commit("logout", {});
                    resolve(result.data);
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