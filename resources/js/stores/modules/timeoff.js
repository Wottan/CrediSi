import http from '../http';

export default {
    namespaced: true,

    state: {
        timeoffList: [],
    },

    actions: {
        load({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/api/timeoff"
                ).then((result) => {
                    commit("timeoffList", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    commit("timeoffList", {});
                    reject(err.response);
                })
            });
        },
        add({ commit }, timeoff) {
            return new Promise((resolve, reject) => {
                http.post("/api/timeoff", timeoff).then((result) => {
                    commit("add", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        update({ commit }, timeoff) {
            return new Promise((resolve, reject) => {
                http.put("/api/timeoff/" + timeoff.id, timeoff
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, timeoff) {
            return new Promise((resolve, reject) => {
                http.delete("/api/timeoff/" + timeoff.id).then((result) => {
                    commit("delete", timeoff);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        timeoffList(state, timeoffList) {
            state.timeoffList = timeoffList
        },
        add(state, timeoff) {
            state.timeoffList = state.timeoffList.filter(s => s.id !== timeoff.id);
            state.timeoffList.push(timeoff);
        },
        update(state, timeoff) {
            state.timeoffList = state.timeoffList.map(t => t.id === timeoff.id ? timeoff : t)
        },
        delete(state, timeoff) {
            state.timeoffList = state.timeoffList.filter(t => t.id !== timeoff.id);
        }
    }
}