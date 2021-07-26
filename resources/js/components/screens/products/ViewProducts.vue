<template v-slot:default>
    <div class="mx-4 my-5 justify-between">
        <table class="table-fixed mx-6">
            <thead class="m-auto">
                <tr>
                    <th class="w-1/4">Image</th>
                    <th class="w-1/4">Name</th>
                    <th class="w-1/4">Price</th>
                    <th class="w-1/4">Edit</th>
                    <th class="w-1/4">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="item in products"
                    :key="item.id"
                    :class="[item.id % 2 === 0 ? '' : 'bg-blue-200']"
                >
                    <td class="p-4 text-center">
                        <img
                            v-if="item.image"
                            class="image"
                            v-bind:src="`${url}/products/${item.image}`"
                        />
                        <img
                            v-else
                            class="image"
                            src="https://cdn.asiatatler.com/asiatatler/i/hk/2020/06/17102237-cars-tesla-model-s_cover_2000x1250.jpg"
                        />
                    </td>
                    <td class="p-4 text-center">{{ item.name }}</td>
                    <td class="p-4 text-center">{{ item.price }}</td>
                    <td class="p-4 text-center items-center content-center">
                        <button
                            @click="
                                () => {
                                    $router.push({
                                        name: 'editProducts',
                                        params: {
                                            id: item.id,
                                            name: item.name,
                                            order: item.order,
                                            image: item.image,
                                            price: item.price,
                                            category: item.category_id,
                                            description: item.description,
                                        },
                                    });
                                }
                            "
                            class="text-white p-2 rounded text-sm button-color"
                        >
                            <font-awesome-icon :icon="['fas', 'pen']" />
                            <span class="ml-2">Edit</span>
                        </button>
                    </td>
                    <td class="p-4 text-center">
                        <button
                            type="submit"
                            @click="deleteProducts(item.id)"
                            class="
                                flex
                                items-center
                                text-white
                                p-2
                                rounded
                                text-sm
                                w-auto
                                primary-bg
                            "
                        >
                            <font-awesome-icon icon="trash" />
                            <span class="ml-2">Delete</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();

        const products = ref([]);
        const url = ref("http://127.0.0.1:8000");
        const getProducts = async () => {
            const res = await axios.get("products");
            if (res.status >= 200 && res.status < 300) {
                console.log(res.data.products);
                products.value = res.data.products;
            }
        };
        getProducts();

        const deleteProducts = async (id) => {
            const res = await axios.delete(
                `http://127.0.0.1:8000/api/delete/product/${id}`
            );
            if (res.status >= 200 && res.status < 300) {
                createToast("Product deleted", {
                    title: "some title",
                    description: "some good description",
                    type: "info",
                });
                products.value = products.value.filter(
                    (product) => product.id !== id
                );
            }
        };
        return {
            products,
            deleteProducts,
            url,
        };
    },
};
</script>

<style lang="scss" scoped></style>
