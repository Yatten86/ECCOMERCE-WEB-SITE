<template>
    <th
        @click="emit('click', field)"
        class="border-b-2 p-2 text-left cursor-pointer bg-gray-100 hover:bg-gray-200 rounded-sm"
        :class="field === sortField ? 'bg-blue-50' : ''"
    >
        <div class="flex items-center justify-between">
            <slot></slot>
            <div v-if="sortField === field" class="ml-2">
                <McSortAscendingFill v-if="sortDirection === 'asc'" />
                <McSortDescendingFill v-else />
            </div>
        </div>
    </th>
</template>

<script setup>
import {
    McSortAscendingFill,
    McSortDescendingFill,
} from "@kalimahapps/vue-icons";

const { field, sortDirection, sortField } = defineProps({
    field: String,
    sortDirection: String,
    sortField: String,
});

const emit = defineEmits(["click"]);
</script>
