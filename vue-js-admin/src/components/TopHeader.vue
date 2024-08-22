<template>
    <header class="flex justify-between items-center h-14 shadow bg-white">
        <button class="p-4">
            <AnOutlinedMenu class="text-3xl text-gray-700" />
        </button>
        <div class="px-4">
            <HeaderUserProfile />
        </div>
    </header>
</template>

<script setup>
import { AnOutlinedMenu } from "@kalimahapps/vue-icons";
import HeaderUserProfile from "./HeaderUserProfile.vue";
</script>
