import api from "@/app/plugins/api";
import type { ApiError } from "@/app/types/api";
import { handleApiError } from "@/app/utils/handleApiError";
import { defineStore } from "pinia";
import { ref } from "vue";
import type { AuthResponse, AuthUser, LoginPayload, RegisterPayload } from "../types/auth";

export const useAuthStore = defineStore("auth", () => {
	const user = ref<AuthUser | null>(null);

	const loading = ref(false);

	const error = ref<ApiError | null>(null);

	const token = localStorage.getItem("token");

	if (token) {
		api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
	}

	async function register(payload: RegisterPayload) {
		try {
			loading.value = true;

			error.value = null;

			await api.get("/sanctum/csrf-cookie");

			const { data } = await api.post("/api/auth/register", payload);

			handleAuthResponse(data);

			return data;
		} catch (err) {
			error.value = handleApiError(err as Error);
		} finally {
			loading.value = false;
		}
	}

	async function login(payload: LoginPayload) {
		try {
			loading.value = true;

			error.value = null;

			await api.get("/sanctum/csrf-cookie");

			const { data } = await api.post<AuthResponse>("/api/auth/login", payload);

			handleAuthResponse(data);

			return data;
		} catch (err) {
			error.value = handleApiError(err as Error);
		} finally {
			loading.value = false;
		}
	}

	async function logout() {
		localStorage.removeItem("token");

		user.value = null;

		delete api.defaults.headers.common["Authorization"];
	}

	function handleAuthResponse(data: AuthResponse) {
		user.value = data.user ?? null;

		if (data.token) {
			localStorage.setItem("token", data.token);

			api.defaults.headers.common["Authorization"] = `Bearer ${data.token}`;
		}
	}

	return {
		user,
		loading,
		error,
		register,
		login,
		logout,
	};
});
