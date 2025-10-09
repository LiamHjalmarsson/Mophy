import { createRouter, createWebHistory } from "vue-router";

import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

const routes = [
	{
		path: "/",
		component: DefaultLayout,
		// children: [{ path: "", name: "home", component: Home }],
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

export default router;
