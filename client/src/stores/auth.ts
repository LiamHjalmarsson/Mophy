import { defineStore } from "pinia";
import { ref } from "vue";
import api from "../plugins/api";
import type { AxiosError } from "axios";
import type { ApiError } from "../types/api";

interface RegisterPayload {
	name: string;
	email: string;
	username: string;
	password: string;
	password_confirmation: string;
}

export interface AuthResponse {
	user: {
		id: number;
		name: string;
		username: string;
		email: string;
		avatar?: string | null;
	};
	token: string;
}

export const useAuthStore = defineStore("auth", () => {
	const user = ref<AuthResponse["user"] | null>(null);

	const loading = ref(false);

	const error = ref<ApiError | null>(null);

	async function register(payload: RegisterPayload) {
		try {
			loading.value = true;

			error.value = null;

			await api.get("/sanctum/csrf-cookie");

			const { data } = await api.post("/api/auth/register", payload);

			user.value = data.user ?? null;

			if (data.token) {
				localStorage.setItem("token", data.token);

				api.defaults.headers.common["Authorization"] = `Bearer ${data.token}`;
			}

			console.log(data);

			return data;
		} catch (err) {
			const axiosError = err as AxiosError<ApiError>;

			error.value = {
				message: axiosError.response?.data?.message || axiosError.message || "Registration failed.",
				errors: axiosError.response?.data?.errors,
				status: axiosError.response?.status,
			};

			console.log(error.value);
		} finally {
			loading.value = false;
		}
	}

	return {
		user,
		loading,
		error,
		register,
	};
});
