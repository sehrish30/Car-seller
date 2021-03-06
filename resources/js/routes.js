import { createRouter, createWebHistory } from "vue-router";

import Signin from "./components/auth/Signin.vue";
import Register from "./components/auth/Register.vue";
import Dashboard from "./components/dashboard/Dashboard.vue";
import ViewCategories from "./components/screens/category/ViewCategories.vue";
import AddCategory from "./components/screens/category/AddCategory.vue";
import EditCategory from "./components/screens/category/EditCategory.vue";
import AddProduct from "./components/screens/products/AddProduct.vue";
import ViewProducts from "./components/screens/products/ViewProducts.vue";
import EditProducts from "./components/screens/products/EditProducts.vue";
import Home from "./components/screens/client/Home.vue";
import Shop from "./components/screens/client/shop/Shop.vue";
import ProductDetails from "./components/screens/client/shop/ProductDetails.vue";
import CategoryProducts from "./components/screens/client/shop/CategoryProducts.vue";
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
        },
        {
            path: "/dashboard",
            component: Dashboard,
            name: "dashboard",
        },
        {
            path: "/categories",
            component: ViewCategories,
            name: "viewcategories",
        },
        {
            path: "/add-category",
            component: AddCategory,
            name: "addCategory",
        },
        {
            path: "/edit-category",
            component: EditCategory,
            name: "editCategory",
            props: true,
        },
        {
            path: "/add-product",
            component: AddProduct,
            name: "addProduct",
        },
        {
            path: "/view-product",
            component: ViewProducts,
            name: "viewProducts",
        },
        {
            path: "/edit-product",
            component: EditProducts,
            name: "editProducts",
            props: true,
        },
        {
            path: "/shop",
            component: Shop,
            name: "Shop",
        },
        {
            path: "/productDetails",
            component: ProductDetails,
            name: "ProductDetails",
            props: true,
        },
        {
            path: "/shop/category",
            component: CategoryProducts,
            name: "CategoryProducts",
            // props: true,
        },
        {
            path: "/:catchAll(.*)",
            component: Home,
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
