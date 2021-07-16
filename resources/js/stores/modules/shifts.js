import http from '../http';

export default {
    namespaced: true,

    state: {
        shifts: [],
    },

    getters: {
        shifts: state => state.shifts,
    },

    actions: {
        load({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/api/shifts"
                ).then((result) => {
                    commit("shifts", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("shifts", {});
                    reject(err.response);
                })
            });
        },
        update({ commit }, shift) {
            return new Promise((resolve, reject) => {
                http.put("/api/shifts/" + shift.id, shift).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                });
            });
        },
        add({ commit }, shift) {
            return new Promise((resolve, reject) => {
                http.post("/api/shifts", shift).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, shift) {
            return new Promise((resolve, reject) => {
                http.delete("/api/shifts/" + shift.id).then((result) => {
                    commit("delete", shift);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        /**
         * Syncronize labels whit shift
         * 
         * @param {*} param0 
         * @param {*} payload id shift and ids of labels
         * @returns 
         */
        syncLabels({ commit }, payload) {
            return new Promise((resolve, reject) => {
                http.put("api/shifts/" + payload.idShift + "/sync", payload.labelIds
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        today({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/api/shifts/today"
                ).then((result) => {
                    commit("shifts", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        active({ commit }, date) {
            return new Promise((resolve, reject) => {
                http.get("/api/shifts/active", { params: { date } }
                ).then((result) => {
                    commit("shifts", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        shifts(state, shifts) {
            state.shifts = shifts
        },
        update(state, shift) {
            state.shifts = state.shifts.map(s => s.id === shift.id ? shift : s);
        },
        delete(state, shift) {
            state.shifts = state.shifts.filter(s => s.id !== shift.id);
        }
    }
}