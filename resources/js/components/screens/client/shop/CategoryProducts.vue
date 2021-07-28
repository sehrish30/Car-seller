<template>
    <h1 class="white--text">{{ category.name }}</h1>
</template>

<script>
import { ref } from "vue";
import { useRoute } from "vue-router";

export default {
    setup() {
        const category = ref("");
        const categories = ref("");
        const route = useRoute();

        console.log("SUNSHINE", router.query);

        const getCategories = async () => {
            await axios.get("categories").then((response) => {
                if (response.status >= 200 && response.status < 300) {
                    categories.value = response.data.categories;
                }
            });
        };
        getCategories();

        return {};
    },
};
</script>

<style lang="scss" scoped></style>
