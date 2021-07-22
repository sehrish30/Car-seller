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
export default {
    components: { AppFooter, AppHeader },
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
