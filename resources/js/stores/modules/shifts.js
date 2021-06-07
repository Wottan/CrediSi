import axios from 'axios';

export default {
    namespaced: true,

    state: {
        shifts: [],
        active: [],
    },

    getters: {
        shifts: state => state.shifts,
        active: state => state.active,
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
        active({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get("/api/shifts/active"
                ).then((result) => {
                    commit("active", result.data);
                    resolve(result);
                }).catch((err) => {
                    commit("active", {});
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        shifts(state, shifts) {
            state.shifts = shifts
        },
        active(state, shifts) {
            state.active = shifts
        },
    }

}