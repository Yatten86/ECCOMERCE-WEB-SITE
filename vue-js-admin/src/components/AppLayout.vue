<template>
    <div class="flex min-h-full">
        <!-- Sidebar -->
        <SideBar />

        <!-- Header -->
        <div class="flex-1">
            <header class="h-8 shadow bg-white">head</header>
            <!-- Content -->
            <main>
                <router-view></router-view>
            </main>
            <!-- Content -->
        </div>
    </div>
</template>

<script setup>
import SideBar from "./SideBar.vue";

const props = defineProps({
    title: String,
});
</script>
