<template>
    <div
        class="w-[200px] transition-all bg-violet-800 rounded-l-xl text-gray-200 py-4 px-2"
    >
        <router-link
            :to="{ name: 'app.dashboard' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400 w-5">
                <AnOutlinedHome class="text-xl" />
            </span>
            <span class="text-md">Dashboard</span>
        </router-link>
        <router-link
            :to="{ name: 'app.products' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <AkClipboard class="text-xl" />
            </span>
            <span class="text-md">Products</span>
        </router-link>
        <router-link
            :to="{ name: 'app.users' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <HiUsers class="text-xl" />
            </span>
            <span class="text-md">Users</span>
        </router-link>
        <router-link
            :to="{ name: 'app.reports' }"
            class="flex items-center p-2 rounded-md transition-colors hover:bg-black/10"
        >
            <span class="mr-3 text-gray-400">
                <IcReports class="text-xl" />
            </span>
            <span class="text-md">Reports</span>
        </router-link>
    </div>
</template>

<script setup>
import {
    AnOutlinedHome,
    AkClipboard,
    HiUsers,
    IcReports,
} from "@kalimahapps/vue-icons";
</script>
