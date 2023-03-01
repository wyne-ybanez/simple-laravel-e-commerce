export function setUser(state, user) {
  state.user.data = user;
}

export function setToken(state, token) {
  state.user.token = token;
  if (token) {
    sessionStorage.setItem('TOKEN', token);
  } else {
    sessionStorage.removeItem('TOKEN')
  }
}

// Let response default to null as a parameter
// Will be set to undefined otherwise and log an error
export function setProduct(state, [loading, response = null]) {

  if (response) {
    state.products = {
        data: response.data,
        links: response.meta.links,
        total: response.meta.total,
        limit: response.meta.per_page,
        from: response.meta.from,
        to: response.meta.to,
        page: response.meta.current_page,
    };
  }

  state.products.loading = loading;
}