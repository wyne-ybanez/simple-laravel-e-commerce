import axiosClient from "../axios";

export function getUser({ commit }, data) {
    return axiosClient.get("/user", data).then(({ data }) => {
        commit("setUser", data);
        return data;
    });
}

export function login({ commit }, data) {
    return axiosClient.post("/login", data).then(({ data }) => {
        commit("setUser", data.user);
        commit("setToken", data.token);
        return data;
    });
}

export function logout({ commit }) {
    return axiosClient.post("/logout").then((response) => {
        commit("setToken", null);

        return response;
    });
}

export function getProducts(
    { commit },
    { url = null, search = "", perPage = 10, sort_field, sort_direction }
) {
    commit("setProduct", [true]);
    url = url || "/product";
    return axiosClient
        .get(url, {
            params: {
                search,
                per_page: perPage,
                sort_field,
                sort_direction,
            },
        })
        .then((res) => {
            commit("setProduct", [false, res.data]);
        })
        .catch(() => {
            commit("setProduct", [false]);
        });
}

export function createProduct({ commit }, product) {
    if (product.image instanceof File) {
        const form = new FormData();
        form.append("title", product.title);
        form.append("image", product.image);
        form.append("description", product.description);
        form.append("price", product.price);
        product = form;
    }
    return axiosClient.post("/product", product);
}

export function updateProduct({ commit }, product) {
  const id = product.id
  if (product.image instanceof File) {
      const form = new FormData();
      form.append("id", product.id);
      form.append("title", product.title);
      form.append("image", product.image);
      form.append("description", product.description);
      form.append("price", product.price);
      form.append("_method", "PUT");
      product = form;
  } else {
      // laravel understands this as an Update
      product._method = "PUT";
  }
  return axiosClient.post(`/product/${id}`, product);
}
