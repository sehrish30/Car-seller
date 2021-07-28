<template>
    <div class="mx-auto h-screen flex content-center">
        <form
            class="
                w-full
                Class
                Properties
                content-center
                max-w-sm
                justify-center
                mx-auto
                items-center
                my-auto
            "
        >
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label
                        class="
                            block
                            text-gray-500
                            font-bold
                            md:text-right
                            mb-1
                            md:mb-0
                            pr-4
                        "
                        for="inline-full-name"
                    >
                        Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input
                        class="
                            bg-gray-200
                            appearance-none
                            border-2 border-gray-200
                            rounded
                            w-full
                            py-2
                            px-4
                            text-gray-700
                            leading-tight
                            focus:outline-none
                            focus:bg-white
                            focus:border-purple-500
                        "
                        id="inline-full-name"
                        type="text"
                        v-model="name"
                    />
                </div>
            </div>

            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label
                        class="
                            block
                            text-gray-500
                            font-bold
                            md:text-right
                            mb-1
                            md:mb-0
                            pr-4
                        "
                        for="price"
                    >
                        Price
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input
                        class="
                            bg-gray-200
                            appearance-none
                            border-2 border-gray-200
                            rounded
                            w-full
                            py-2
                            px-4
                            text-gray-700
                            leading-tight
                            focus:outline-none
                            focus:bg-white
                            focus:border-purple-500
                        "
                        id="price"
                        type="text"
                        v-model="price"
                    />
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label
                        class="
                            block
                            text-gray-500
                            font-bold
                            md:text-right
                            mb-1
                            md:mb-0
                            pr-4
                        "
                        for="description"
                    >
                        Description
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea
                        class="
                            bg-gray-200
                            appearance-none
                            border-2 border-gray-200
                            rounded
                            w-full
                            py-2
                            px-4
                            text-gray-700
                            leading-tight
                            focus:outline-none
                            focus:bg-white
                            focus:border-purple-500
                        "
                        id="description"
                        type="text"
                        v-model="description"
                    />
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label
                        class="
                            block
                            text-gray-500
                            font-bold
                            md:text-right
                            mb-1
                            md:mb-0
                            pr-4
                        "
                        for="image"
                    >
                        Image
                    </label>
                </div>
                <div class="md:w-2/3 bg-gray-300">
                    <label
                        class="
                            w-64
                            flex flex-col
                            items-center
                            px-2
                            py-2
                            rounded-md
                            uppercase
                            border border-blue
                            cursor-pointer
                            hover:bg-purple-600 hover:text-white
                            text-purple-600
                            ease-linear
                            transition-all
                            duration-150
                        "
                    >
                        <div class="flex flex-row">
                            <font-awesome-icon
                                icon="camera"
                                class="mt-3 mr-2"
                            />
                            <span class="mt-2 text-base leading-normal">
                                {{
                                    imageName ? imageName : "Select a file"
                                }}</span
                            >
                        </div>
                        <input
                            type="file"
                            class="hidden"
                            @change="someHandler"
                        />
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label
                    class="
                        block
                        uppercase
                        tracking-wide
                        text-gray-700 text-xs
                        font-bold
                        mb-2
                    "
                    for="grid-state"
                >
                    Subject
                </label>
                <div class="relative">
                    <select
                        v-model="selectedCategory"
                        return-object
                        class="
                            block
                            appearance-none
                            w-full
                            bg-gray-200
                            border border-gray-200
                            text-gray-700
                            py-3
                            px-4
                            pr-8
                            rounded
                            leading-tight
                            focus:outline-none
                            focus:bg-white
                            focus:border-gray-500
                        "
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <div
                        class="
                            pointer-events-none
                            absolute
                            inset-y-0
                            right-0
                            flex
                            items-center
                            px-2
                            text-gray-700
                        "
                    >
                        <svg
                            class="fill-current h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="md:flex items-center mx-auto">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button
                        @click="submit"
                        class="
                            shadow
                            bg-purple-500
                            hover:bg-purple-400
                            focus:shadow-outline focus:outline-none
                            text-white
                            font-bold
                            py-2
                            px-4
                            rounded
                        "
                        type="button"
                    >
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

export default {
    //      props: {
    //     category: {
    //       type: String,
    //       required: true
    //     }
    //   },
    props: ["id", "name", "order", "price", "image", "description", "category"],

    setup(props) {
        console.log("AZAB", props.category);
        const name = ref(props.name);
        const order = ref(props.order);
        const image = ref("");
        const price = ref(props.price);
        const categories = ref([]);
        const category = ref(props.category);
        const description = ref(props.description);
        const imageName = ref(props.image);
        const selectedCategory = ref(props.category);
        const router = useRouter();

        const someHandler = (e) => {
            // console.log(e.target.value.split("\\").pop());
            console.log(e.target.files[0]);
            e.preventDefault();
            image.value = e.target.files[0];
            imageName.value = e.target.value.split("\\").pop();
        };

        const submit = async () => {
            try {
                let formData = new FormData();
                formData.append("name", name.value);
                formData.append("order", order.value);
                image.value && formData.append("image", image.value);
                formData.append("description", description.value);
                formData.append("price", price.value);
                formData.append("category", category.value);
                console.log("AZAAB");
                const res = await axios.post(
                    `http://127.0.0.1:8000/api/update/product/${props.id}`,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                if (res.status >= 200 && res.status < 300) {
                    router.push({
                        name: "viewProducts",
                    });
                }
            } catch (e) {
                console.log(e);
            }
        };
        const getCategories = async () => {
            await axios.get("categories").then((response) => {
                if (response.status >= 200 && response.status < 300) {
                    console.log(response.data.categories);
                    categories.value = response.data.categories;
                }
            });
        };
        // getCategories();
        console.log(props);
        onMounted(getCategories);
        return {
            someHandler,
            submit,
            imageName,
            name,
            image,
            price,
            description,
            categories,
            category,
            selectedCategory,
        };
    },
};
</script>

<style lang="scss" scoped></style>
