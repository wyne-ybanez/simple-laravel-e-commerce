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

//===== Products

/**
 * Get Products:
 *
 * These parameters are primarily whats used to display the products on the table prior to any filtering or queries.
 * Params: @url , @search , @per_page , @sort_field , @sort_direction
 */
export function getProducts(
    { commit, state },
    { url = null, search = "", per_page, sort_field, sort_direction } = {}
) {
    commit("setProduct", [true]);
    url = url || "/products";

    const params = {
        per_page: state.products.limit,
    };

    return axiosClient
        .get(url, {
            params: {
                ...params,
                search,
                per_page,
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

export function getProduct({ commit }, id) {
    return axiosClient.get(`/products/${id}`);
}

export function createProduct({ commit }, product) {
    const formImageAppend = (fieldName, imageFile) => {
        if (imageFile instanceof File) {
            form.append(fieldName, imageFile || null);
        }
    };

    const form = new FormData();
    formImageAppend("image", product.image);
    formImageAppend("image_1", product.image_1);
    formImageAppend("image_2", product.image_2);
    formImageAppend("image_3", product.image_3);
    form.append("title", product.title);
    form.append("category", product.category);
    form.append("description", product.description || "");
    form.append("description_2", product.description_2 || "");
    form.append("price", product.price);
    form.append("color", product.color ? 1 : 0);
    product = form;

    return axiosClient.post("/products", product);
}

export function updateProduct({ commit }, product) {
    const id = product.id;
    const form = new FormData();

    const formImageAppend = (fieldName, imageFile) => {
        if (imageFile instanceof File) {
            form.append(fieldName, imageFile || null);
        }
    };

    formImageAppend("image", product.image); // these must be in order
    formImageAppend("image_1", product.image_1);
    formImageAppend("image_2", product.image_2);
    formImageAppend("image_3", product.image_3);
    form.append("id", product.id);
    form.append("title", product.title);
    form.append("category", product.category);
    form.append("description", product.description || "");
    form.append("description_2", product.description_2 || "");
    form.append("price", product.price);
    form.append("color", product.color ? 1 : 0);
    form.append("_method", "PUT");
    product = form;

    return axiosClient.post(`/products/${id}`, form);
}

export function deleteProduct({ commit }, id) {
    return axiosClient.delete(`/products/${id}`);
}

//===== Orders

/**
 * Get Orders:
 *
 * These parameters are primarily whats used to display the users on the table prior to any filtering or queries.
 * Params: @url , @search , @per_page , @sort_field , @sort_direction
 */
export function getOrders(
    { commit, state },
    { url = null, search = "", per_page, sort_field, sort_direction } = {}
) {
    commit("setOrders", [true]);
    url = url || "/orders";

    const params = {
        per_page: state.orders.limit,
    };

    return axiosClient
        .get(url, {
            params: {
                ...params,
                search,
                per_page,
                sort_field,
                sort_direction,
            },
        })
        .then((res) => {
            commit("setOrders", [false, res.data]);
        })
        .catch(() => {
            commit("setOrders", [false]);
        });
}

export function getOrder({ commit }, id) {
    return axiosClient.get(`/orders/${id}`);
}

// TODO: Apply this function in the view
export function deleteOrder({ commit }, id) {
    return axiosClient.delete(`/orders/${id}`);
}

//===== Users

/**
 * Get Users:
 *
 * These parameters are primarily whats used to display the users on the table prior to any filtering or queries.
 * Params: @url , @search , @per_page , @sort_field , @sort_direction
 */
export function getUsers(
    { commit, state },
    { url = null, search = "", per_page, sort_field, sort_direction } = {}
) {
    commit("setUser", [true]);
    url = url || "/users";

    const params = {
        per_page: state.users.limit,
    };

    return axiosClient
        .get(url, {
            params: {
                ...params,
                search,
                per_page,
                sort_field,
                sort_direction,
            },
        })
        .then((res) => {
            commit("setUsers", [false, res.data]);
        })
        .catch(() => {
            commit("setUsers", [false]);
        });
}

export function createUser({ commit }, user) {
    return axiosClient.post("/users", user);
}

export function updateUser({ commit }, user) {
    return axiosClient.put(`/users/${user.id}`, user);
}

export function deleteUser({ commit }, id) {
    return axiosClient.delete(`/users/${id}`);
}
