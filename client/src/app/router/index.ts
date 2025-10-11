import { createRouter, createWebHistory } from "vue-router";
import DefaultLayout from "@app/layouts/DefaultLayout.vue";
import AuthLayout from "@app/layouts/AuthLayout.vue";

import Home from "@/modules/home/Home.vue";
import Dashboard from "@/modules/dashboard/pages/Dashboard.vue";
import Login from "@/modules/auth/pages/Login.vue";
import Register from "@/modules/auth/pages/Register.vue";

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
