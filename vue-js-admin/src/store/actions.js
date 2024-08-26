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
