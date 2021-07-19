import http from '../http';

export default {
    namespaced: true,

    state: {
        labels: [],
    },

    getters: {
        labels: state => state.labels,
    },

    actions: {
        load({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/api/labels"
                ).then((result) => {
                    commit("labels", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    commit("labels", {});
                    reject(err.response);
                })
            });
        },
        upsert({ commit }, labels) {
            return new Promise((resolve, reject) => {
                http.post("api/labels/upsert", labels
                ).then((result) => {
                    commit("labels", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        update({ commit }, labels) {
            return new Promise((resolve, reject) => {
                http.put("api/labels/bulk", labels
                ).then((result) => {
                    commit("labels", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, label) {
            return new Promise((resolve, reject) => {
                http.delete("/api/labels/" + label.id).then((result) => {
                    commit("delete", label);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        labels(state, labels) {
            state.labels = labels
        },
        delete(state, label) {
            state.labels = state.labels.filter(l => l.id !== label.id);
        }
    }

}