import axiosClient from "../axios";

export function getCurrentUser({ commit }, data) {
    return axiosClient.get("/user", data)
        .then(({ data }) => {
            commit("setUser", data);
            return data;
        });
}

export function login({commit}, data) {
    return axiosClient.post('/login', data)
        .then(({data}) => {
            commit("setUser", data.user); // from AuthController.php
            commit("setToken", data.token); // from AuthController.php
            return data;
        })
}

export function logout({commit}) {
    return axiosClient.post('/logout')
        .then((response) => {
            commit('setToken', null)
            return response;
        })
}