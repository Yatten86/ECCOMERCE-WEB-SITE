<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/75" @click="closeModal" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white text-left align-middle shadow-xl transition-all"
                        >
                            <!-- <DisabledSpiner
                                v-if="loading"
                                class="animate-spin absolute left-0 top-100 bg-white right-0 bottom-0 flex items-center justify-center"
                            /> -->

                            <header
                                class="flex py-3 px-4 justify-between items-center"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    {{
                                        product.id
                                            ? `Update product: "${props.product.title}"`
                                            : "Create new Product"
                                    }}
                                </DialogTitle>
                                <button
                                    @click="closeModal()"
                                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
                                >
                                    <CgCloseO class="h-6 w-6" />
                                </button>
                            </header>
                            <form @submit.prevent="onSubmit">
                                <div class="bg-white px-4 pt-5 pb-4">
                                    <CustomInput
                                        class="mb-2"
                                        v-model="product.title"
                                        label="Product Title"
                                    />
                                    <CustomInput
                                        type="file"
                                        class="mb-2"
                                        label="Product Image"
                                        v-model="product.image"
                                    />
                                    <CustomInput
                                        type="textarea"
                                        class="mb-2"
                                        v-model="product.description"
                                        label="Description"
                                    />
                                    <CustomInput
                                        type="number"
                                        clas="mb-2"
                                        v-model="product.price"
                                        label="Price"
                                        prepend="€"
                                    />
                                </div>
                                <footer
                                    class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                                >
                                    <button
                                        type="submit"
                                        class="mt-3 inline-flex justify-center border-gray-300 shadow-sm hover focus:ring-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm py-2 px-4 w-full border border-transparent text-sm font-medium rounded-md text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-offset-2 focus:ring-violet-500"
                                    >
                                        Submit
                                    </button>
                                    <button
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        @click="closeModal"
                                        ref="cancelButtonRef"
                                    >
                                        Cancel
                                    </button>
                                </footer>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { computed, onUpdated, ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import store from "../../store";
import { CgCloseO } from "@kalimahapps/vue-icons";
import DisabledSpiner from "../../components/core/DisabledSpiner.vue";
import CustomInput from "../../components/core/CustomInput.vue";

const loading = ref(false);

const props = defineProps({
    modelValue: Boolean,
    product: {
        require: true,
        type: Object,
    },
});

const emit = defineEmits(["update:modelValue", "close"]);

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const product = ref({
    id: props.product.id,
    title: props.product.title,
    image: props.product.image,
    description: props.product.description,
    price: props.product.price,
});

onUpdated(() => {
    product.value = {
        id: props.product.id,
        title: props.product.title,
        image: props.product.image,
        description: props.product.description,
        price: props.product.price,
    };
});

function closeModal() {
    show.value = false;
    emit("close");
}

function onSubmit() {
    loading.value = true;
    if (product.value.id) {
        store.dispatch("updateProduct", product.value).then((response) => {
            loading.value = false;
            if (response.status === 200) {
                //TODO show notification
                store.dispatch("getProducts", {});
                closeModal();
            }
        });
    } else {
        store.dispatch("createProduct", product.value).then((response) => {
            loading.value = false;
            if (response.status === 201) {
                //TODO show notification
                store.dispatch("getProducts", {});
                closeModal();
            }
        });
    }
}
</script>
