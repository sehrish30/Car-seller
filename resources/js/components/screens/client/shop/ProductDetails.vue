<template>
    <div class="h-screen max-w-2xl mx-auto mt-24 space-y-20">
        <div class="max-w-screen-md md:w-3/4 mx-auto">
            <div
                class="
                    inline-flex
                    flex-col
                    space-y-2
                    items-center
                    justify-end
                    flex-1
                    h-full
                    p-4
                    bg-blue-800
                    rounded-xl
                "
            >
                <p class="w-full text-2xl font-semibold text-white">
                    {{ product.name }}
                </p>
                <p
                    class="
                        w-full
                        pb-8
                        text-sm
                        tracking-wide
                        leading-tight
                        text-white
                    "
                >
                    {{ product.description }}
                </p>
                <div class="rounded mr-auto">
                    <div class="opacity-95 border rounded-lg border-white px-4">
                        <p
                            class="
                                m-auto
                                inset-0
                                text-sm
                                font-medium
                                leading-normal
                                text-center text-white
                                py-2
                            "
                        >
                            Add to cart
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
export default {
    props: [
        "id",
        "name",
        "price",
        "description",
        "image",
        "category_id",
        "category",
    ],
    setup(props) {
        console.log("PROPS", props);
        const product = reactive({
            id: props.id,
            name: props.name,
            price: props.price,
            description: props.description,
            image: props.image,
            category_id: props.category_id,
            category: props.category,
        });
        console.log(product);
        return {
            product,
        };
    },
};
</script>

<style lang="scss" scoped></style>
