<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton class="flex items-center">
                <img
                    src="/img/user.jpg"
                    alt="user img"
                    class="rounded-full w-9 mr-2"
                />
                <small>{{ currentUser.name }}</small>
                <AkChevronDownSmall
                    class="h-5 w-5 text-violet-200 hover:text-violet-100"
                    aria-hidden="true"
                />
            </MenuButton>
        </div>

        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <MenuItems
                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
            >
                <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                        <button
                            :class="[
                                active
                                    ? 'bg-violet-500 text-white'
                                    : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]"
                        >
                            <GlProfile
                                :active="active"
                                class="mr-2 h-5 w-5 text-violet-400"
                                aria-hidden="true"
                            />
                            Profile
                        </button>
                    </MenuItem>
                </div>

                <MenuItem v-slot="{ active }">
                    <button
                        @click="logout"
                        :class="[
                            active
                                ? 'bg-violet-500 text-white'
                                : 'text-gray-900',
                            'group flex w-full items-center rounded-md px-2 py-2 text-sm ml-1',
                        ]"
                    >
                        <HuLogout
                            :active="active"
                            class="mr-2 h-5 w-5 text-violet-400"
                            aria-hidden="true"
                        />
                        Logout
                    </button>
                </MenuItem>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup>
import {
    AkChevronDownSmall,
    AnOutlinedMenu,
    HuLogout,
    GlProfile,
} from "@kalimahapps/vue-icons";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import store from "../store";
import router from "../router";
import { computed } from "vue";

const currentUser = computed(() => store.state.user.data);

function logout() {
    console.log("Logout called");
    store.dispatch("logout").then(() => {
        router.push({ name: "login" });
        console.log("loged out");
    });
}
</script>
