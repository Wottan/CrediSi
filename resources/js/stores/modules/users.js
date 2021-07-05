import http from '../http';

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
                http.get("/api/users"
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
                http.put("/api/users/" + user.id, user
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        /**
         * Syncronize labels whit user
         * 
         * @param {*} param0 
         * @param {*} payload id user and ids of labels
         * @returns 
         */
        syncLabels({ commit }, payload) {
            return new Promise((resolve, reject) => {
                http.put("api/users/" + payload.idUser + "/sync", payload.labelIds
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