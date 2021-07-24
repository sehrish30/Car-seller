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
                        for="order"
                    >
                        Order
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
                        id="order"
                        type="text"
                        v-model="order"
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

            <div class="md:flex items-center mx-auto">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button
                        @click="submitForm"
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
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";

export default {
    props: ["id", "name", "order", "image"],
    setup(props) {
        console.log(props);
        const router = useRouter();
        const name = ref(props.name);
        const order = ref(props.order);
        const imageName = ref("");
        const image = ref("");

        const someHandler = (e) => {
            // console.log(e.target.value.split("\\").pop());
            console.log(e.target.files[0]);
            e.preventDefault();
            image.value = e.target.files[0];
            imageName.value = e.target.value.split("\\").pop();
        };

        const submitForm = () => {
            let formData = new FormData();
            name.value && formData.append("name", name.value);
            order.value && formData.append("order", order.value);
            image.value && formData.append("image", image.value);
            formData.append("oldImage", props.image);
            console.log("FORMDATA", name.value, order.value);
            axios
                .post(
                    `http://127.0.0.1:8000/api/update/category/${props.id}`,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                )
                .then((response) => {
                    if (response.status >= 200 && response.status < 300) {
                        router.push("viewcategories");
                    }
                    router.push({
                        name: "viewcategories",
                    });
                });
        };

        return {
            name,
            order,
            image,
            imageName,
            someHandler,
            submitForm,
        };
    },
};
</script>

<style lang="scss" scoped></style>
