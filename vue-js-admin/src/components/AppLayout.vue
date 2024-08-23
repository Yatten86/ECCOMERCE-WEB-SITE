<template>
    <div class="flex min-h-full bg-gray-200">
        <!-- Sidebar -->
        <Sidebar :class="{ '-ml-[200px]': !sidebarOpen }" />

        <!-- Header -->
        <div class="flex-1">
            <TopHeader @toggle-sidebar="toggleSidebar" />
            <!-- Content -->
            <main class="p-6">
                <div class="p-4 rounded bg-white">
                    <router-view></router-view>
                </div>
            </main>
            <!-- Content -->
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Sidebar from "./Sidebar.vue";
import TopHeader from "./TopHeader.vue";

const sidebarOpen = ref(true);

function toggleSidebar() {
    sidebarOpen.value = !sidebarOpen.value;
}
</script>
