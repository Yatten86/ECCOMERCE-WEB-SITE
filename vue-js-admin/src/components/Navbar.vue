<template>
    <header class="flex justify-between items-center p-2 shadow bg-white">
        <button
            @click="emit('toggle-sidebar')"
            class="flex items-center justify-center rounded transition-colors p-4 hover:bg-black/10 hover:shadow"
        >
            <AnOutlinedMenu class="text-3xl text-gray-700" />
        </button>

        <HeaderUserProfile />
    </header>
</template>

<script setup>
import { AnOutlinedMenu } from "@kalimahapps/vue-icons";
import HeaderUserProfile from "./HeaderUserProfile.vue";

const emit = defineEmits(["toggle-sidebar"]);
</script>
