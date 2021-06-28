import axios from 'axios';

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
                axios.get("/api/labels"
                ).then((result) => {
                    commit("labels", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("labels", {});
                    reject(err.response);
                })
            });
        },
        upsert({ commit }, labels) {
            return new Promise((resolve, reject) => {
                axios.post("api/labels/upsert", labels
                ).then((result) => {
                    commit("labels", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        update({ commit }, labels) {
            return new Promise((resolve, reject) => {
                axios.put("api/labels/bulk", labels
                ).then((result) => {
                    commit("labels", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, label) {
            return new Promise((resolve, reject) => {
                axios.delete("/api/labels/" + label.id).then((result) => {
                    commit("delete", label);
                    resolve(result);
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