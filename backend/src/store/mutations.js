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

// Give an empty object as a parameter
// Will be set to undefined otherwise and log an error
export function setProduct(state, [loading, response = {}]) {
  state.products.loading = loading;
  state.products.data = response.data;
}