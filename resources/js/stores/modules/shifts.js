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
                    resolve(result.data);
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
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                });
            });
        },
        editable({ commit }, id, date) {
            return new Promise((resolve, reject) => {
                http.get("/api/shifts/" + id, { params: { date }}).then((result) => {
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                });
            });
        },
        forUser({ commit }, id, date) {
            return new Promise((resolve, reject) => {
                http.get("/api/shifts/user/" + id, { params: { date }}).then((result) => {
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                });
            });
        },
        
        add({ commit }, shift) {
            return new Promise((resolve, reject) => {
                http.post("/api/shifts", shift).then((result) => {
                    commit("add", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, shift) {
            return new Promise((resolve, reject) => {
                http.delete("/api/shifts/" + shift.id).then((result) => {
                    commit("delete", shift);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        syncLabels({ commit }, payload) {
            return new Promise((resolve, reject) => {
                http.put("api/shifts/" + payload.id + "/sync", payload.labelIds
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result.data);
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
                    resolve(result.data);
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
                    resolve(result.data);
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
        add(state, shift) {
            state.shifts = state.shifts.filter(s => s.id !== shift.id);
            state.shifts.push(shift);
        },
        update(state, shift) {
            state.shifts = state.shifts.map(s => s.id === shift.id ? shift : s);
        },
        delete(state, shift) {
            state.shifts = state.shifts.filter(s => s.id !== shift.id);
        }
    }
}