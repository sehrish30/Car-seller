<template>
    <div class="flex flex-col h-screen justify-between">
        <app-header />
        <main class="flex-grow bg-blue-100">
            <router-view></router-view>
        </main>
        <app-footer />
    </div>
</template>

<script>
import AppFooter from "./partials/Footer.vue";
import AppHeader from "./partials/Header.vue";
import { useRouter } from "vue-router";

export default {
    components: { AppFooter, AppHeader },
    setup() {
        const router = useRouter();
        if (localStorage.getItem("token")) {
            router.push({
                name: "dashboard",
            });
        }
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
