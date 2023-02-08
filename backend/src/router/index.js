import { createRouter, createWebHistory } from "vue-router"
import Dashboard from "../views/Dashboard.vue"
import Products from "../views/Products.vue"
import Login from "../views/Login.vue"
import RequestPassword from "../views/RequestPassword.vue"
import ResetPassword from "../views/ResetPassword.vue"
import AppLayout from "../components/AppLayout.vue"

const routes = [
    {
        path: "/",
        redirect: "/app",
    },
    {
        path: "/app",
        name: "app",
        component: AppLayout,
        children: [
            {
                path: "dashboard",
                name: "app.dashboard",
                component: Dashboard,
            },
            {
                path: "products",
                name: "app.products",
                component: Products,
            },
            {
                path: "users",
                name: "app.users",
                component: Dashboard,
            },
            {
                path: "customers",
                name: "app.customers",
                component: Dashboard,
            },
            {
                path: "customers/:id",
                name: "app.customers.view",
                component: Dashboard,
            },
            {
                path: "orders",
                name: "app.orders",
                component: Dashboard,
            },
            {
                path: "orders/:id",
                name: "app.orders.view",
                component: Dashboard,
            },
            {
                path: "/report",
                name: "reports",
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                },
            },
        ],
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/request-password",
        name: "requestPassword",
        component: RequestPassword,
    },
    {
        path: "/reset-password/:token",
        name: "resetPassword",
        component: ResetPassword,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;