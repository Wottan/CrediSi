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
                axios.get("/api/users/labels"
                ).then((result) => {
                    commit("users", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("users", {});
                    reject(err.response);
                })
            });
        },
        update({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios.put("/api/users/" + user.id, user
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },

        updateLabel({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.post("api/users/" + payload.idUser + "/label", payload.labelIds
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        users(state, users) {
            state.users = users
        },
        update(state, user) {
            state.users = state.users.filter(u => u.id !== user.id);
            state.users.push(user);
        },
    }
}