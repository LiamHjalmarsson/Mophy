<script setup lang="ts">
import { reactive } from "vue";
import { PhEnvelope, PhLock, PhSignIn } from "@phosphor-icons/vue";
import { useAuthStore } from "../../stores/auth";
import BaseInput from "../../components/ui/BaseInput.vue";
import BaseButton from "../../components/ui/BaseButton.vue";

const authStore = useAuthStore();

const credentials = reactive({
	email: "",
	password: "",
});

async function handleLogin(): Promise<void> {
	try {
		await authStore.login({
			email: credentials.email,
			password: credentials.password,
		});

		console.log("✅ Logged in:", authStore.user);
	} catch (err) {
		console.error("❌ Login failed:", authStore.error);
	}
}
</script>

<template>
	<div class="w-full max-w-lg p-2 border border-white/20 rounded-2xl">
		<div class="bg-white/10 backdrop-blur-md text-white rounded-xl shadow-2xl p-8 border border-white/20">
			<div class="flex flex-col items-center mb-8">
				<h1 class="text-3xl font-bold text-center">Welcome Back</h1>
				<p class="text-gray-300 text-sm mt-2">Sign in to continue to your dashboard</p>
			</div>

			<form @submit.prevent="handleLogin" class="space-y-6">
				<BaseInput v-model="credentials.email" label="Email" type="email" placeholder="you@example.com">
					<PhEnvelope class="absolute right-3 top-3.5 text-gray-400" size="20" />
				</BaseInput>

				<BaseInput v-model="credentials.password" label="Password" type="password" placeholder="••••••••">
					<PhLock class="absolute right-3 top-3.5 text-gray-400" size="20" />
				</BaseInput>

				<p v-if="authStore.error" class="text-red-400 text-sm text-center mt-2">
					{{ authStore.error.message }}
				</p>

				<BaseButton
					type="submit"
					:disabled="authStore.loading"
					:label="authStore.loading ? 'Logging in...' : 'Login'">
					<PhSignIn size="20" weight="bold" />
				</BaseButton>
			</form>

			<p class="text-center text-sm text-gray-300 mt-6">
				Don’t have an account?
				<RouterLink to="/register" class="block text-blue-400 hover:text-blue-300 font-bold">
					Register
				</RouterLink>
			</p>

			<SocialAuth />
		</div>
	</div>
</template>
