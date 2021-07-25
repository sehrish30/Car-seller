<template>
    <nav
        v-if="token"
        class="flex items-center justify-between flex-wrap blue-color p-2"
    >
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <img
                class="mx-auto h-12 w-auto"
                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                alt="Workflow"
            />
            <!-- <span class="anto primary-color">CARS</span> -->
        </div>
        <div class="block lg:hidden">
            <button
                class="
                    flex
                    items-center
                    px-3
                    py-2
                    border
                    rounded
                    text-teal-200
                    border-teal-400
                    hover:text-white hover:border-white
                "
            >
                <svg
                    class="fill-current h-3 w-3"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <router-link
                    :to="{ name: 'viewcategories' }"
                    class="
                        primary-color
                        block
                        mt-4
                        lg:inline-block lg:mt-0
                        text-teal-200
                        hover:text-white
                        mr-4
                    "
                >
                    Categories
                </router-link>
                <router-link
                    :to="{ name: 'viewProducts' }"
                    class="
                        primary-color
                        block
                        mt-4
                        lg:inline-block lg:mt-0
                        text-teal-200
                        hover:text-white
                        mr-4
                    "
                >
                    Products
                </router-link>
                <router-link
                    :to="{ name: 'addCategory' }"
                    class="
                        primary-color
                        block
                        mt-4
                        lg:inline-block lg:mt-0
                        text-teal-200
                        hover:text-white
                        mr-4
                    "
                >
                    Add category
                </router-link>
                <router-link
                    :to="{ name: 'addProduct' }"
                    class="
                        primary-color
                        block
                        mt-4
                        lg:inline-block lg:mt-0
                        text-teal-200
                        hover:text-white
                        mr-4
                    "
                >
                    Add product
                </router-link>
            </div>
            <div>
                <button
                    @click="logout"
                    type="button"
                    class="
                        primary-color
                        inline-block
                        text-sm
                        px-4
                        py-2
                        leading-none
                        border
                        rounded
                        text-white
                        mt-4
                        lg:mt-0
                    "
                >
                    Logout
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
import { ref, watchEffect } from "vue";
import { useRouter } from "vue-router";
export default {
    setup() {
        const router = useRouter();
        const logout = () => {
            console.log("LOGOUT");
            localStorage.removeItem("token");
            token.value = "";
            router.push({
                name: "login",
            });
        };
        console.log("MOUNTED");
        const token = ref(localStorage.getItem("token"));
        localStorage.getItem("token");
        console.log(token);

        watchEffect(() => {
            console.log("CRY", token.value);
            token.value = localStorage.getItem("token");
        });

        return {
            token,
            logout,
        };
    },
};
</script>

<style lang="scss" scoped>
@import "../../../css/support.scss";
</style>
