import axios from 'axios';

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
                axios.get("/api/shifts"
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
                axios.put("/api/shifts/" + shift.id, shift).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                });
            });
        },
        add({ commit }, shift) {
            return new Promise((resolve, reject) => {
                axios.post("/api/shifts", shift).then((result) => {
                    commit("update", result.data);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, shift) {
            return new Promise((resolve, reject) => {
                axios.delete("/api/shifts/" + shift.id).then((result) => {
                    commit("delete", shift);
                    resolve(result);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        updateLabel({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.post("api/shifts/" + payload.idShift + "/label", payload.labelIds
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
                axios.get("/api/shifts/today"
                ).then((result) => {
                    commit("shifts", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("shifts", {});
                    reject(err.response);
                })
            });
        },
        active({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get("/api/shifts/active"
                ).then((result) => {
                    commit("shifts", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("shifts", {});
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
            state.shifts = state.shifts.filter(s => s.id !== shift.id);
            state.shifts.push(shift);
        },
        delete(state, shift) {
            state.shifts = state.shifts.filter(s => s.id !== shift.id);
        }
    }
}