import axiosClient from "../axios";

export function getUser({commit}, data) {
  return axiosClient.get('/user', data)
    .then(({data}) => {
      commit('setUser', data);
      return data;
    })
}

export function login({commit}, data) {
  return axiosClient.post('/login', data)
    .then(({data}) => {
      commit('setUser', data.user);
      commit('setToken', data.token)
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

export function getProducts({commit}, {url = null}) {
  commit('setProduct', [true])
  url = url || '/product'
  return axiosClient.get(url)
    .then(res => {
      commit('setProduct', [false, res.data])
    })
    .catch(() => {
      commit("setProduct", [false]);
    })
}
