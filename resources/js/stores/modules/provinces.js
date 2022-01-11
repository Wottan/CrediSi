import http from '../http';

export default {
    namespaced: true,

    state: {
        provinces: [],
    },

    getters: {
        provinces: state => state.provinces,
    },

    actions: {
        load({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/api/provinces"
                ).then((result) => {
                    commit("provinces", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    commit("provinces", {});
                    reject(err.response);
                })
            });
        },
        add({ commit }, province) {
            return new Promise((resolve, reject) => {
                http.post("/api/provinces", province).then((result) => {
                    commit("add", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, province) {
            return new Promise((resolve, reject) => {
                http.delete("/api/provinces/" + province.id).then((result) => {
                    commit("delete", province);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        update({ commit }, province) {
            return new Promise((resolve, reject) => {
                http.put("/api/provinces/" + province.id, user
                ).then((result) => {
                    commit("update", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
    },

    mutations: {
        provinces(state, provinces) {
            state.provinces = provinces
        },
        add(state, province) {
            state.provinces = state.provinces.filter(s => s.id !== province.id);
            state.provinces.push(province);
        },
        update(state, province) {
            state.provinces = state.provinces.map(u => u.id === province.id ? province : u)
        },
        delete(state, province) {
            state.provinces = state.provinces.filter(s => s.id !== province.id);
        }
    }
}