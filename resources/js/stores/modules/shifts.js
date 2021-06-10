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
                axios.put("/api/shifts/" + shift.id, user
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
        shifts(state, shifts) {
            state.shifts = shifts
        },
    }

}