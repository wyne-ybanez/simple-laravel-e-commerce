import { createRouter, createWebHistory } from "vue-router";
import AppLayout from "../components/AppLayout.vue";
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";
import ProductsIndex from "../views/Products/ProductsIndex.vue";
import ProductShow from "../views/Products/ProductShow.vue";
import UsersIndex from "../views/Users/UsersIndex.vue";
import UserShow from "../views/Users/UserShow.vue";
import CustomersIndex from "../views/Customers/CustomersIndex.vue";
import CustomerShow from "../views/Customers/CustomerShow.vue";
import OrdersIndex from "../views/Orders/OrdersIndex.vue";
import OrderShow from "../views/Orders/OrderShow.vue";
import RequestPassword from "../views/RequestPassword.vue";
import ResetPassword from "../views/ResetPassword.vue";
import NotFound from "../views/NotFound.vue";
import store from "../store/index.js";

const routes = [
    {
        path: "/",
        name: "app",
        component: AppLayout,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: "dashboard",
                name: "app.dashboard",
                component: Dashboard,
            },
            {
                path: "products",
                name: "app.products",
                component: ProductsIndex,
            },
            {
                path: "products/create",
                name: "app.products.create",
                component: ProductShow,
            },
            {
                path: "products/:id",
                name: "app.products.view",
                component: ProductShow,
                props: {
                    // ensures the id value is an integer, must be numeric value
                    id: (value) => /^\d+$/.test(value)
                }
            },
            {
                path: "users",
                name: "app.users",
                component: UsersIndex,
            },
            {
                path: "users/create",
                name: "app.users.create",
                component: UserShow,
            },
            {
                path: "users/:id",
                name: "app.users.view",
                component: UserShow,
                props: {
                    // ensures the id value is an integer, must be numeric value
                    id: (value) => /^\d+$/.test(value)
                }
            },
            {
                path: "customers",
                name: "app.customers",
                component: CustomersIndex,
            },
            {
                path: "customers/:id",
                name: "app.customers.view",
                component: CustomerShow,
            },
            {
                path: "orders",
                name: "app.orders",
                component: OrdersIndex,
            },
            {
                path: "orders/:id",
                name: "app.orders.view",
                component: OrderShow,
                props: true
            },
        ],
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            requiresGuest: true,
        },
    },
    {
        path: "/request-password",
        name: "requestPassword",
        component: RequestPassword,
        meta: {
            requiresGuest: true,
        },
    },
    {
        path: "/reset-password/:token",
        name: "resetPassword",
        component: ResetPassword,
        meta: {
            requiresGuest: true,
        },
    },
    {
        path: "/:pathMatch(.*)",
        name: "notfound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "login" });
    } else if (to.meta.requiresGuest && store.state.user.token) {
        next({ name: "app.dashboard" });
    } else {
        next();
    }
});

export default router;
