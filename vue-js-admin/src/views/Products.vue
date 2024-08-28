<template>
    <div>
        <!-- <pre>{{ products.data }}</pre> -->
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-3xl font-semibold">Products</h1>
            <button
                type="submit"
                class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-violet-600 hover:bg-violet-500/90"
            >
                Add new Product
            </button>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex justify-between border-b-2 pb-3">
                <div class="flex itmes-center justify-center">
                    <span class="whitespace-nowarp mr-3">Per page</span>
                    <select
                        @change="getProducts"
                        v-model="perPage"
                        class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:ring-violet-500 focus:z-10 sm:text-sm"
                    >
                        <option value="5">5</option>
                        <option value="5">10</option>
                        <option value="5">20</option>
                        <option value="5">50</option>
                        <option value="5">100</option>
                    </select>
                </div>
                <div>
                    <input
                        v-model="search"
                        @change="getProducts(null)"
                        placeholder="Type to Search products"
                        class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:ring-violet-500 focus:z-10 sm:text-sm"
                    />
                </div>
            </div>

            <DisabledSpiner
                v-if="products.loading"
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
            />
            <template v-else>
                <div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 p-2 text-left">ID</th>
                                <th class="border-b-2 p-2 text-left">Image</th>
                                <th class="border-b-2 p-2 text-left">Title</th>
                                <th class="border-b-2 p-2 text-left">Price</th>
                                <th class="border-b-2 p-2 text-left">
                                    Last Updated At
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="product of products.data"
                                :key="product.id"
                            >
                                <td class="border-b p-2">{{ product.id }}</td>
                                <td class="border-b p-2">
                                    <img
                                        class="w-16"
                                        :src="product.image"
                                        :alt="product.title"
                                    />
                                </td>
                                <td
                                    class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis"
                                >
                                    {{ product.title }}
                                </td>
                                <td class="border-b p-2">
                                    {{ product.price }}
                                </td>
                                <td class="border-b p-2">
                                    {{ product.updated_at }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import DisabledSpiner from "../components/DisabledSpiner.vue";
import store from "../store";
import { PRODUCTS_PER_PAGE } from "../constants";

const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref("");
const products = computed(() => store.state.products);

onMounted(() => {
    getProducts();
});

function getProducts() {
    store.dispatch("getProducts");
}
</script>
