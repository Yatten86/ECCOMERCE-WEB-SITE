<template>
    <div class="flex min-h-full bg-gray-200">
        <!-- Sidebar -->
        <SideBar />

        <!-- Header -->
        <div class="flex-1">
            <TopHeader />
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
import SideBar from "./SideBar.vue";
import TopHeader from "./TopHeader.vue";

const props = defineProps({
    title: String,
});
</script>
