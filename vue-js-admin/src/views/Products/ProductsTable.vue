<template>
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between border-b-2 pb-3">
            <div class="flex itmes-center justify-center">
                <span class="whitespace-nowarp mr-3">Per page</span>
                <select
                    @change="getProducts(null)"
                    v-model="perPage"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:ring-violet-500 focus:z-10 sm:text-sm"
                >
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div>
                <input
                    v-model="search"
                    @change.prevent="getProducts(null)"
                    placeholder="Type to Search products"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:ring-violet-500 focus:z-10 sm:text-sm"
                />
            </div>
        </div>

        <div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="">
                        <TableHeaderCell
                            @click="sortProduct"
                            field="id"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >ID</TableHeaderCell
                        >
                        <TableHeaderCell
                            field=""
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Image</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProduct"
                            field="title"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Title</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProduct"
                            field="price"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Price</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProduct"
                            field="updated_at"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                        >
                            Last Updated At
                        </TableHeaderCell>
                    </tr>
                </thead>
                <tbody v-if="products.loading">
                    <tr>
                        <td colspan="5">
                            <!-- check why is not working -->
                            <DisabledSpiner
                                v-if="products.loading"
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                            />
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr v-for="product of products.data" :key="product.id">
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
            <div
                v-if="!products.loading"
                class="flex justify-between items-center mt-5"
            >
                <span>
                    Showing from {{ products.from }} to
                    {{ products.to }}
                </span>
                <nav
                    v-if="products.total > products.limit"
                    class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <a
                        v-for="(link, i) of products.links"
                        :key="i"
                        :disabled="!link.url"
                        href="#"
                        @click="getForPage($event, link)"
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                        :class="
                            (link.active
                                ? 'z-10 bg-violet-500 text-violet-600'
                                : 'bg-whte border-gray-300 text-gray-500 hover:bg-gray-50',
                            i === 0 ? 'rounded-md' : '',
                            i === products.links.length - 1
                                ? 'rounded-r-md'
                                : '',
                            !link.url ? 'bg-gray-100 text-gray-700' : '')
                        "
                        v-html="link.label"
                    ></a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import DisabledSpiner from "../../components/core/DisabledSpiner.vue";
import store from "../../store";
import { PRODUCTS_PER_PAGE } from "../../constants";
import TableHeaderCell from "../../components/core/table/TableHeaderCell.vue";

const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref("");
const products = computed(() => store.state.products);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

onMounted(() => {
    getProducts();
});

function getProducts(url = null) {
    store.dispatch("getProducts", {
        url,
        sort_field: sortField.value,
        sort_direction: sortDirection.value,
        search: search.value,
        perPage: perPage.value,
    });
}

function getForPage(event, link) {
    if (!link.url || link.active) {
        return;
    }
    getProducts(link.url);
}

function sortProduct(field) {
    if (sortField.value === field) {
        if (sortDirection.value === "asc") {
            sortDirection.value = "desc";
        } else {
            sortDirection.value = "asc";
        }
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }

    getProducts();
}
</script>
