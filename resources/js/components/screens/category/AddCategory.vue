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
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();

        const name = ref("");
        const order = ref("");
        const image = ref("");
        const imageName = ref("");

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
                formData.append("image", image.value);
                const res = await axios.post(
                    "http://127.0.0.1:8000/api/add/category",
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                if (res.status >= 200 && res.status <= 300) {
                    console.log(res.data.name);
                    router.push({
                        name: "viewcategories",
                    });
                }
            } catch (e) {
                console.log(e);
            }
        };
        return {
            name,
            order,
            image,
            someHandler,
            submit,
            imageName,
        };
    },
};
</script>

<style lang="scss" scoped></style>
