import axiosClient from "../axios";

export function login({ commit }, data) {
    return axiosClient.post("/login", data).then(({ data }) => {
        commit("setUser", data);
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

export function getUser({ commit }) {
    return axiosClient.get("/user").then((response) => {
        console.log(response.data);
        commit("setUser", response.data);
        return response;
    });
}

export function getProducts(
    { commit },
    { url = null, search = "", perPage = "", sort_field, sort_direction } = {}
) {
    commit("setProducts", [true]);

    url = url || "/products";
    // if (!url) url = "/products";
    return axiosClient
        .get(url, {
            params: { search, per_page: perPage, sort_field, sort_direction },
        })
        .then((response) => {
            commit("setProducts", [false, response.data]);
        })
        .catch(() => {
            commit("setProducts", [false]);
        });
}

export function getProduct({}, id) {
    return axiosClient.get(`/products/${id}`);
}

export function createProduct({ commit }, product) {
    const form = new FormData();
    form.append("title", product.title);
    form.append("description", product.description);
    form.append("price", product.price);

    // Check if an image is provided
    if (product.image instanceof File) {
        form.append("image", product.image);
    }
    for (let pair of form.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }

    return axiosClient.post("/products", form);
}

// Updated updateProduct
export function updateProduct({ commit }, product) {
    const form = new FormData();
    const id = product.id; // Make sure product.id exists before updating

    // Append product fields to FormData
    form.append("title", product.title);
    form.append("description", product.description);
    form.append("price", product.price);
    form.append("_method", "PUT");

    // Only append image if it exists
    if (product.image instanceof File) {
        form.append("image", product.image);
    }

    // Send POST request with FormData
    return axiosClient.post(`/products/${id}`, form, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
}

export function deleteProduct({ commit }, id) {
    return axiosClient.delete(`/products/${id}`);
}
