<script setup lang="ts">
import { reactive } from "vue";
import { PhEnvelope, PhLock, PhSignIn } from "@phosphor-icons/vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";
import BaseInput from "@/shared/components/ui/BaseInput.vue";
import BaseButton from "@/shared/components/ui/BaseButton.vue";
import AuthCard from "../components/AuthCard.vue";

const { login, user, error, loading } = useAuthStore();

const router = useRouter();

const credentials = reactive({
	email: "",
	password: "",
});

async function handleLogin(): Promise<void> {
	try {
		await login({
			email: credentials.email,
			password: credentials.password,
		});

		await router.push({ name: "dashboard" });

		console.log("Logged in:", user);
	} catch (err) {
		console.error("Login failed:", error);
	}
}
</script>

<template>
	<AuthCard title="Welcome Back" subtitle="Login to access your account" @submit="handleLogin">
		<BaseInput v-model="credentials.email" label="Email" type="email" placeholder="you@example.com">
			<PhEnvelope class="absolute right-3 top-3.5" size="20" />
		</BaseInput>

		<BaseInput v-model="credentials.password" label="Password" type="password" placeholder="••••••••">
			<PhLock class="absolute right-3 top-3.5" size="20" />
		</BaseInput>

		<p v-if="error" class="text-red-400 text-sm text-center mt-5">
			{{ error.message }}
		</p>

		<BaseButton type="submit" :disabled="loading" :label="loading ? 'Logging in...' : 'Login'">
			<PhSignIn size="20" weight="bold" />
		</BaseButton>

		<template #footer>
			<p class="text-center text-sm text-gray-300 mt-10">
				Don’t have an account?
				<RouterLink to="/register" class="text-fuchsia-400 hover:text-fuchsia-300 font-bold">
					Register
				</RouterLink>
			</p>
		</template>
	</AuthCard>
</template>
