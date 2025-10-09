import { defineStore } from "pinia";
import { ref } from "vue";
import api from "../plugins/api";
import type { ApiError } from "../types/api";
import { handleApiError } from "../utils/handleApiError";

export interface RegisterPayload {
	name: string;
	email: string;
	username: string;
	password: string;
	password_confirmation: string;
}

export interface LoginPayload {
	email: string;
	password: string;
}

export interface AuthUser {
	id: number;
	name: string;
	username: string;
	email: string;
	avatar?: string | null;
}

export interface AuthResponse {
	user: AuthUser;
	token: string;
}

export const useAuthStore = defineStore("auth", () => {
	const user = ref<AuthUser | null>(null);

	const loading = ref(false);

	const error = ref<ApiError | null>(null);

	async function register(payload: RegisterPayload) {
		try {
			loading.value = true;

			error.value = null;

			await api.get("/sanctum/csrf-cookie");

			const { data } = await api.post("/api/auth/register", payload);

			user.value = data.user ?? null;

			console.log(user.value);

			if (data.token) {
				localStorage.setItem("token", data.token);

				api.defaults.headers.common["Authorization"] = `Bearer ${data.token}`;
			}

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

			user.value = data.user;

			localStorage.setItem("token", data.token);

			api.defaults.headers.common["Authorization"] = `Bearer ${data.token}`;

			return data;
		} catch (err) {
			error.value = handleApiError(err as Error);
		} finally {
			loading.value = false;
		}
	}

	return {
		user,
		loading,
		error,
		register,
		login,
	};
});
