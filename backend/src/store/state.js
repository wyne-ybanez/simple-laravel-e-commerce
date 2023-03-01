export default {
  user: {
    token: sessionStorage.getItem('TOKEN'),
    data: {},
  },
  products: {
    loading: false,
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null,
    // response: [],
  }
}
