<template>
    <head>
        <title>Shop</title>
        <link
            href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css"
            rel="stylesheet"
        />
    </head>

    <body class="bg-white font-sans leading-normal tracking-normal">
        <div class="grid grid-cols-3 gap-4">
            <div class="p-10" v-for="product in products" :key="product.id">
                <!--Card 1-->
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img
                        class="w-full"
                        v-bind:src="`${url}/products/${product.image}`"
                        alt="Mountain"
                    />
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Mountain</div>
                        <p class="text-gray-700 text-base">
                            {{ product.name }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span
                            class="
                                inline-block
                                bg-gray-200
                                rounded-full
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-gray-700
                                mr-2
                                mb-2
                            "
                        >
                            {{ product.price }}</span
                        >
                        <span
                            class="
                                inline-block
                                bg-gray-200
                                rounded-full
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-gray-700
                                mr-2
                                mb-2
                            "
                            >{{ product.category?.name }}</span
                        >
                        <span
                            class="
                                inline-block
                                bg-gray-200
                                rounded-full
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-gray-700
                                mr-2
                                mb-2
                            "
                            >#winter</span
                        >
                        <button
                            @click="() => productDetails(product)"
                            class="
                                text-center text-indigo-400
                                font-bold
                                rounded
                                py-2
                                w-2/12
                                focus:outline-none
                                bg-gray-900
                                border-2 border-indigo-400
                            "
                        >
                            Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="p-10" v-for="category in categories" :key="category.id">
                <!--Card 1-->
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img
                        class="w-full"
                        v-bind:src="`${url}/products/${category.image}`"
                        alt="Mountain"
                    />
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Mountain</div>
                        <p class="text-gray-700 text-base">
                            {{ category.name }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span
                            class="
                                inline-block
                                bg-gray-200
                                rounded-full
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-gray-700
                                mr-2
                                mb-2
                            "
                        >
                            {{ category.price }}</span
                        >
                        <span
                            class="
                                inline-block
                                bg-gray-200
                                rounded-full
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-gray-700
                                mr-2
                                mb-2
                            "
                            >{{ category?.name }}</span
                        >
                        <span
                            class="
                                inline-block
                                bg-gray-200
                                rounded-full
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-gray-700
                                mr-2
                                mb-2
                            "
                            >#winter</span
                        >

                        <button
                            @click="() => navigateToCategoryScreen(category)"
                            class="
                                text-center text-indigo-400
                                font-bold
                                rounded
                                py-2
                                w-2/12
                                focus:outline-none
                                bg-gray-900
                                border-2 border-indigo-400
                            "
                        >
                            Category
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";
export default {
    setup() {
        const categories = ref([]);
        const products = ref([]);
        const url = ref("http://127.0.0.1:8000");
        const router = useRouter();

        const productDetails = (product) => {
            router.push({
                name: "ProductDetails",
                params: {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    description: product.description,
                    image: product.image,
                    category_id: product.category_id,
                    category: product.category,
                },
            });
        };

        const getCategories = async () => {
            await axios.get(`/categories`).then((res) => {
                console.log("ASIM", res.data.categories, res.status >= 200);
                if (res.status >= 200 && res.status < 300) {
                    categories.value = res.data.categories;
                }
            });
        };
        getCategories();
        const getLatestProducts = async () => {
            axios.get("latestProducts").then((response) => {
                if (response.status >= 200 && response.status < 300) {
                    console.log("HATE", response.data.products);
                    products.value = response.data.products;
                }
            });
        };
        getLatestProducts();

        const navigateToCategoryScreen = (category) => {
            console.log(category);
            // router.push({
            //     name: "CategoryProducts",
            //     query: { category },
            // });
        };
        return {
            products,
            url,
            productDetails,
            categories,
            navigateToCategoryScreen,
        };
    },
};
</script>

<style lang="scss" scoped>
.carousel-open:checked + .carousel-item {
    position: static;
    opacity: 100;
}
.carousel-item {
    -webkit-transition: opacity 0.6s ease-out;
    transition: opacity 0.6s ease-out;
}
#carousel-1:checked ~ .control-1,
#carousel-2:checked ~ .control-2,
#carousel-3:checked ~ .control-3 {
    display: block;
}
.carousel-indicators {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    bottom: 2%;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 10;
}
#carousel-1:checked
    ~ .control-1
    ~ .carousel-indicators
    li:nth-child(1)
    .carousel-bullet,
#carousel-2:checked
    ~ .control-2
    ~ .carousel-indicators
    li:nth-child(2)
    .carousel-bullet,
#carousel-3:checked
    ~ .control-3
    ~ .carousel-indicators
    li:nth-child(3)
    .carousel-bullet {
    color: #2b6cb0; /*Set to match the Tailwind colour you want the active one to be */
}
</style>
