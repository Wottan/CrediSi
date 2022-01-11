import http from '../http';

export default {
    namespaced: true,

    state: {
        abonados: [],
    },

    getters: {
        abonados: state => state.abonados,
    },

    actions: {
        load({ commit }) {
            return new Promise((resolve, reject) => {
                http.get("/api/abonados"
                ).then((result) => {
                    commit("abonados", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    commit("abonados", {});
                    reject(err.response);
                })
            });
        },
        add({ commit }, abonado) {
            return new Promise((resolve, reject) => {
                http.post("/api/abonados", abonado).then((result) => {
                    commit("add", result.data);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        delete({ commit }, abonado) {
            return new Promise((resolve, reject) => {
                http.delete("/api/abonados/" + abonado.id).then((result) => {
                    commit("delete", abonado);
                    resolve(result.data);
                }).catch((err) => {
                    reject(err.response);
                })
            });
        },
        update({ commit }, abonado) {
            return new Promise((resolve, reject) => {
                http.put("/api/abonados/" + abonado.id, abonado
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
        abonados(state, abonados) {
            state.abonados = abonados
        },
        add(state, abonado) {
            state.abonados = state.abonados.filter(s => s.id !== abonado.id);
            state.abonados.push(abonado);
        },
        update(state, abonado) {
            state.abonados = state.abonados.map(u => u.id === abonado.id ? abonado : u)
        },
        delete(state, abonado) {
            state.abonados = state.abonados.filter(s => s.id !== abonado.id);
        }
    }
}