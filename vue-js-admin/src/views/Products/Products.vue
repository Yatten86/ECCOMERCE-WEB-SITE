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

        <ProductModal
            v-model="showModal"
            :product="productModel"
            @close="onModalClose"
        />
        <ProductsTable @clickEdit="editProduct" />
    </div>
</template>

<script setup>
import ProductsTable from "./ProductsTable.vue";
import ProductModal from "./ProductModal.vue";
import store from "../../store";
import { ref } from "vue";

const DEFAULT_EMPTY_OBJECT = {
    id: "",
    title: "",
    image: "",
    description: "",
    price: "",
};

const showModal = ref(false);
const productModel = ref({ ...DEFAULT_EMPTY_OBJECT });

function showProductModal() {
    showModal.value = true;
}

function editProduct(product) {
    store.dispatch("getProduct", product.id).then(({ data }) => {
        console.log(data);
        productModel.value = data;
        showProductModal();
    });
}

function onModalClose() {
    productModel.value = { ...DEFAULT_EMPTY_OBJECT };
}
</script>
