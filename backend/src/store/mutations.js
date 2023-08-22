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

// Let 'data' default to null as a parameter
// Will be set to undefined otherwise and log an error
export function setProduct(state, [loading, data = null]) {
  if (data) {
    state.products = {
        ...state.products,
        data: data.data,
        links: data.meta.links,
        total: data.meta.total,
        limit: data.meta.per_page,
        from: data.meta.from,
        to: data.meta.to,
        page: data.meta.current_page,
    };
  }

  state.products.loading = loading;
}

export function setOrders(state, [loading, data = null]) {
  if (data) {
    state.orders = {
        ...state.orders,
        data: data.data,
        links: data.meta.links,
        total: data.meta.total,
        limit: data.meta.per_page,
        from: data.meta.from,
        to: data.meta.to,
        page: data.meta.current_page,
    };
  }

  state.orders.loading = loading;
}