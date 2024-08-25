<template>
    <div class="flex min-h-full bg-gray-200">
        <!-- Sidebar -->
        <Sidebar
            :class="{
                '-ml-[200px]': !sidebarOpen,
            }"
        />

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
import { ref, onMounted, onUnmounted } from "vue";
import Sidebar from "./Sidebar.vue";
import TopHeader from "./Navbar.vue";
import store from "../store";

const sidebarOpen = ref(true);

function toggleSidebar() {
    sidebarOpen.value = !sidebarOpen.value;
}

//hides the sidebar on smaller screens
function handleResize() {
    if (window.outerWidth <= 768) {
        sidebarOpen.value = false;
    } else {
        sidebarOpen.value = true;
    }
}

onMounted(() => {
    store.dispatch("getUser");
    console.log("s-a montat");
    handleResize();
    window.addEventListener("resize", handleResize);
});

onUnmounted(() => {
    window.removeEventListener("resize", handleResize);
});
</script>
