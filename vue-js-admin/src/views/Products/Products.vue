<template>
    <div>
        <!-- <pre>{{ products.data }}</pre> -->
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-3xl font-semibold">Products</h1>
            <button
                @click="showProductModal"
                type="submit"
                class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-violet-600 hover:bg-violet-500/90"
            >
                Add new Product
            </button>
        </div>

        <ProductModal v-model="showModal" />
        <ProductsTable />
    </div>
</template>

<script setup>
import ProductsTable from "./ProductsTable.vue";
import ProductModal from "./ProductModal.vue";
import { ref } from "vue";

const showModal = ref(false);

function showProductModal() {
    showModal.value = true;
}
</script>
