<template>
    <div class="mx-4 my-5 justify-between">
        <table class="table-fixed mx-6">
            <thead class="m-auto">
                <tr>
                    <th class="w-1/4">Image</th>
                    <th class="w-1/4">Name</th>
                    <th class="w-1/4">Order</th>
                    <th class="w-1/4">Edit</th>
                    <th class="w-1/4">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="item in categories"
                    :key="item.id"
                    :class="[item.id % 2 === 0 ? '' : 'bg-blue-200']"
                >
                    <td class="p-4 text-center">
                        <img
                            v-if="item.image"
                            class="image"
                            v-bind:src="`${url}/images/${item.image}`"
                        />
                        <img
                            v-else
                            class="image"
                            src="https://cdn.asiatatler.com/asiatatler/i/hk/2020/06/17102237-cars-tesla-model-s_cover_2000x1250.jpg"
                        />
                    </td>
                    <td class="p-4 text-center">{{ item.name }}</td>
                    <td class="p-4 text-center">{{ item.order }}</td>
                    <td class="p-4 text-center items-center content-center">
                        <button
                            type="submit"
                            class="text-white p-2 rounded text-sm button-color"
                        >
                            <font-awesome-icon :icon="['fas', 'pen']" />
                            <span class="ml-2">Edit</span>
                        </button>
                    </td>
                    <td class="p-4 text-center">
                        <button
                            type="submit"
                            @click="deleteCategory(item.id)"
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

export default {
    setup() {
        const categories = ref([]);
        const url = ref("http://127.0.0.1:8000");
        const getCategories = async () => {
            const res = await axios.get("http://localhost:8000/api/categories");
            if (res.status >= 200 && res.status < 300) {
                console.log(res.data.categories);
                categories.value = res.data.categories;
            }
        };
        getCategories();

        const deleteCategory = async (id) => {
            console.log("DELETE");
            try {
                const response = await axios.delete(
                    `http://127.0.0.1:8000/api/delete/category/${id}`
                );
                if (response.status >= 200 && response.status < 300) {
                    createToast("Category deleted", {
                        title: "some title",
                        description: "some good description",
                        type: "info",
                    });
                    categories.value = categories.value.filter(
                        (category) => category.id !== id
                    );
                }
            } catch (err) {
                console.log(err);
            }
        };

        return {
            categories,
            url,
            deleteCategory,
        };
    },
};
</script>

<style lang="scss" scoped>
@import "../../../../css/support.scss";
.image {
    height: 100px;
    width: 100px;
    object-fit: cover;
}
</style>
