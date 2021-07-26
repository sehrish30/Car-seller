<template>
    <div class="flex flex-col h-screen justify-between">
        <p v-if="authenticated">Dashboard</p>
        <p v-else>Not logged in</p>
    </div>
</template>

<script>
import { ref } from "vue";

import AppFooter from "../partials/Footer.vue";
import AppHeader from "../partials/Header.vue";
export default {
    components: { AppFooter, AppHeader },
    setup() {
        const authenticated = ref(false);
        const authCheck = async () => {
            await axios.get("http://localhost:8000/api/user").then((res) => {
                console.log("USER", res);
                if (res.status >= 200 && res.status < 300) {
                    authenticated.value = true;
                }
            });
        };
        authCheck();
        return {
            authenticated,
        };
    },
};
</script>

<style lang="scss" scoped></style>
