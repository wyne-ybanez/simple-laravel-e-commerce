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

// Products
export function getProducts(
    /**
     * Get Products:
     *
     * These parameters are primarily whats used to display the products on the table prior to any filtering or queries.
     * If an object argument is not passed, we want products to display anyway by default.
     * Hence, an empty object argument will be equivalent to that of these set values.
     *
     * Params: @url , @search , @per_page , @sort_field , @sort_direction
     */
    { commit, state },
    { url = null, search = "", per_page, sort_field, sort_direction } = {}
) {
    commit("setProduct", [true]);
    url = url || "/products";

    const params = {
        per_page: state.products.limit,
    }

    return axiosClient
        .get(url, {
            params: {
                ...params,
                search, per_page, sort_field, sort_direction,
            },
        })
        .then((res) => {
            commit("setProduct", [false, res.data]);
        })
        .catch(() => {
            commit("setProduct", [false]);
        });
}

export function getProduct({ commit }, id) {
    return axiosClient.get(`/products/${id}`)
}

export function createProduct({ commit }, product) {
    if (product.image instanceof File) {
        const form = new FormData();
        form.append("title", product.title);
        form.append("image", product.image);
        form.append("category", product.category);
        form.append("description", product.description || '');
        form.append("description_2", product.description_2 || '');
        form.append("price", product.price);
        form.append("color", product.color ? 1 : 0);
        product = form;
    }
    return axiosClient.post("/products", product);
}

export function updateProduct({ commit }, product) {
    const id = product.id
    // Main image
    if (product.image instanceof File) {
        const form = new FormData();
        form.append("id", product.id);
        form.append("title", product.title);
        form.append("image", product.image);
        form.append("category", product.category);
        form.append("description", product.description || '');
        form.append("description_2", product.description_2 || '');
        form.append("price", product.price);
        form.append("color", product.color ? 1 : 0);
        form.append("_method", "PUT");
        product = form;
    } else {
        // laravel understands this as an Update
        product._method = "PUT";
    }

    // Image 1
    if (product.image_1 instanceof File) {
        const form = new FormData();
        form.append("id", product.id);
        form.append("title", product.title);
        form.append("image_1", product.image_1);
        form.append("category", product.category);
        form.append("description", product.description || '');
        form.append("description_2", product.description_2 || '');
        form.append("price", product.price);
        form.append("color", product.color ? 1 : 0);
        form.append("_method", "PUT");
        product = form;
    }
    else {
        product._method = "PUT";
    }

    // Image 2
    if (product.image_2 instanceof File) {
        const form = new FormData();
        form.append("id", product.id);
        form.append("title", product.title);
        form.append("image_2", product.image_2);
        form.append("category", product.category);
        form.append("description", product.description || '');
        form.append("description_2", product.description_2 || '');
        form.append("price", product.price);
        form.append("color", product.color ? 1 : 0);
        form.append("_method", "PUT");
        product = form;
    }
    else {
        product._method = "PUT";
    }

    // Image 3
    if (product.image_3 instanceof File) {
        const form = new FormData();
        form.append("id", product.id);
        form.append("title", product.title);
        form.append("image_3", product.image_3);
        form.append("category", product.category);
        form.append("description", product.description || '');
        form.append("description_2", product.description_2 || '');
        form.append("price", product.price);
        form.append("color", product.color ? 1 : 0);
        form.append("_method", "PUT");
        product = form;
    }
    else {
        product._method = "PUT";
    }

    return axiosClient.post(`/products/${id}`, product);
}

export function deleteProduct({ commit }, id) {
    return axiosClient.delete(`/products/${id}`)
}

// Orders
export function getOrders({ commit, state }, { url = null, search = "", per_page, sort_field, sort_direction } = {}) {
    commit("setOrders", [true]);
    url = url || "/orders";

    const params = {
        per_page: state.orders.limit,
    }

    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
    .then((res) => {
        commit('setOrders', [false, res.data])
    })
    .catch(() => {
        commit('setOrders', [false])
    })
}

export function getOrder({ commit }, id) {
    return axiosClient.get(`/orders/${id}`)
}

// TODO: Apply this function in the view
export function deleteOrder({ commit }, id) {
    return axiosClient.delete(`/orders/${id}`)
}