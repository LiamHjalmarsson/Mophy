import { createRouter, createWebHistory } from "vue-router";
import DefaultLayout from "../layouts/DefaultLayout.vue";
import Dashboard from "../pages/dashboard/Dashboard.vue";
import AuthLayout from "../layouts/AuthLayout.vue";
import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";
import Home from "../pages/home/Home.vue";

const routes = [
	{
		path: "/",
		component: DefaultLayout,
		children: [
			{ path: "", name: "home", component: Home, meta: { public: true } },
			{
				path: "dashboard",
				name: "dashboard",
				component: Dashboard,
				meta: { requiresAuth: true },
			},
		],
	},

	{
		path: "/",
		component: AuthLayout,
		children: [
			{ path: "login", name: "login", component: Login, meta: { guest: true } },
			{ path: "register", name: "register", component: Register, meta: { guest: true } },
		],
	},
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

router.beforeEach((to, _from, next) => {
	const token = localStorage.getItem("token");

	if (to.meta.requiresAuth && !token) {
		next({ name: "login" });
	} else if (to.meta.guest && token) {
		next({ name: "dashboard" });
	} else {
		next();
	}
});

export default router;
