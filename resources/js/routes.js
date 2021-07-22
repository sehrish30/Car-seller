import { createRouter, createWebHistory } from "vue-router";

import Signin from "./components/auth/Signin.vue";
import Register from "./components/auth/Register.vue";

// import store from "./store/index";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: Signin,
            name: "home",
        },
        {
            path: "/login",
            component: Signin,
            name: "login",
            alias: "/",
        },
        {
            path: "/register",
            component: Register,
            name: "register",
            alias: "/",
        },
    ],
});

// Navigation guard
// router.beforeEach((to, from, next) => {
//     // router has meta requiresAuth our own property true
//     if (to.matched.some((record) => record.meta.requiresAuth)) {
//         if (!store.getters["posts/authenticated"]) {
//             next({ name: "login" });
//         } else {
//             next();
//         }
//     } else {
//         next();
//     }
// });
export default router;
