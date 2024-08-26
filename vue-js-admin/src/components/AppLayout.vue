<template>
    <div v-if="currentUser.id" class="flex min-h-full bg-gray-200">
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
    <div v-else class="min-h-full bg-gray-200 flex items-center justify-center">
        <DisabledSpiner class="animate-spin -ml-1 mr-3 h-8 w-8 text-black" />
        <span>Please Wait...</span>
    </div>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from "vue";
import Sidebar from "./Sidebar.vue";
import TopHeader from "./Navbar.vue";
import DisabledSpiner from "./DisabledSpiner.vue";
import store from "../store";

const sidebarOpen = ref(true);
const currentUser = computed(() => store.state.user.data);

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
