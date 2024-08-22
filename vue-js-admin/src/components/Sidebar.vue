<template>
    <div class="w-[200px] bg-indigo-700 rounded-l-xl text-gray-200 py-4 px-2">
        <router-link
            :to="{ name: 'app.dashboard' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <HomeIcon class="w-5" />
            </span>
            <span class="text-md">Dashboard</span>
        </router-link>
        <router-link
            :to="{ name: 'app.dashboard' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <ClipboardDocumentListIcon class="w-5" />
            </span>
            <span class="text-md">Products</span>
        </router-link>
        <router-link
            :to="{ name: 'app.dashboard' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <UsersIcon class="w-5" />
            </span>
            <span class="text-md">Users</span>
        </router-link>
        <router-link
            :to="{ name: 'app.dashboard' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <BarsArrowUpIcon class="w-5" />
            </span>
            <span class="text-md">Reports</span>
        </router-link>
    </div>
</template>

<script setup>
import {
    HomeIcon,
    ClipboardDocumentListIcon,
    UsersIcon,
    BarsArrowUpIcon,
} from "@heroicons/vue/24/outline";
</script>
