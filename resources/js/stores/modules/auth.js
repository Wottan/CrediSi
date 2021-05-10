import axios from 'axios';

export default {
    namespaced: true,

    state: {
        user: {},
    },

    getters: {
        user: state => state.user,
    },

    actions: {
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                axios.post("/api/login", credentials
                ).then((result) => {
                    commit("setUser", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("setUser", {});
                    reject(err.response);
                })
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios.post("/api/logout"
                ).then((result) => {
                    commit("setUser", {});
                    resolve(result);
                }).catch(err => {
                    reject(err);
                })
            });
        }
    },

    mutations: {
        setUser(state, user) {
            state.user = user
        },
    }

}