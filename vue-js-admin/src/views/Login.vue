<template>
    <div
        class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
    >
        <GuestLayout title="Sign in to your account">
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" method="POST" @submit.prevent="login">
                    <div
                        v-if="errorMsg"
                        class="flex items-center justify-between py-3 px-5 bg-red-500 text-white rounded"
                    >
                        {{ errorMsg }}
                        <span
                            @click="errorMsg = ''"
                            class="w-8 h-4 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-black/20"
                            ><CdChromeClose
                        /></span>
                    </div>
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Email address</label
                        >
                        <div class="mt-2">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required=""
                                v-model="user.email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Password</label
                            >
                            <div class="text-sm">
                                <router-link
                                    :to="{ name: 'requestPassword' }"
                                    class="font-semibold text-indigo-600 hover:text-indigo-500"
                                    >Forgot password?</router-link
                                >
                            </div>
                        </div>
                        <div class="mt-2">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required=""
                                v-model="user.password"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember-me"
                            name="remember-me"
                            v-model="user.remember"
                            class="h-4 w-4 text focus:ring-violet-500 checked:bg-violet-600 border-gray-300 rounded"
                        />
                        <label
                            for="remember-me"
                            class="ml-2 block text-sm text-gray-900"
                            >Remember me</label
                        >
                    </div>

                    <div>
                        <button
                            :disabled="loading"
                            :class="{
                                'cursor-not-allowed': loading,
                                'hover:bg-viloet-300': loading,
                            }"
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-violet-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            <DisabledSpiner v-if="loading" />
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </GuestLayout>
    </div>
</template>

<script setup>
import { CdChromeClose } from "@kalimahapps/vue-icons";
import { ref } from "vue";
import GuestLayout from "../components/GuestLayout.vue";
import store from "../store";
import router from "../router";
import DisabledSpiner from "../components/DisabledSpiner.vue";

let loading = ref(false);
let errorMsg = ref("");

const user = {
    email: "",
    password: "",
    remember: false,
};

function login() {
    loading.value = true;
    store
        .dispatch("login", user)
        .then(() => {
            loading.value = false;
            router.push({ name: "app.dashboard" });
        })
        .catch(({ response }) => {
            loading.value = false;
            errorMsg.value = response.data.message;
        });
}
</script>
