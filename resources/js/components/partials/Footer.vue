<template>
    <footer v-if="token" class="min-h-10 bg-blue-600">Footer</footer>
</template>

<script>
import { ref } from "vue";
export default {
    setup() {
        const token = ref(localStorage.getItem("token"));
        localStorage.getItem("token");
        return {
            token,
        };
    },
};
</script>

<style lang="scss" scoped></style>
