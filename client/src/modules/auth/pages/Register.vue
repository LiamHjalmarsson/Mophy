<script setup lang="ts">
import { PhUser, PhLock, PhEnvelope, PhUserCirclePlus } from "@phosphor-icons/vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";
import BaseButton from "@/shared/components/ui/BaseButton.vue";
import BaseInput from "@/shared/components/ui/BaseInput.vue";
import AuthCard from "../components/AuthCard.vue";

const { register, error } = useAuthStore();

const router = useRouter();

const user = reactive({
	email: "",
	username: "",
	password: "",
	password_confirmation: "",
});

async function handleRegister() {
	try {
		await register({
			email: user.email,
			username: user.username,
			password: user.password,
			password_confirmation: user.password_confirmation,
		});

		await router.push({ name: "dashboard" });
	} catch (e) {
		console.error("Registration failed:", error);
	}
}
</script>

<template>
	<AuthCard title="Create Account" subtitle="Join our community and get started today" @submit="handleRegister">
		<BaseInput v-model="user.username" label="Username" placeholder="John Doe">
			<PhUser class="absolute right-3 top-3.5" size="20" />
		</BaseInput>

		<BaseInput v-model="user.email" label="Email" placeholder="you@example.com" type="email">
			<PhEnvelope class="absolute right-3 top-3.5" size="20" />
		</BaseInput>

		<BaseInput v-model="user.password" label="Password" placeholder="••••••••" type="password">
			<PhLock class="absolute right-3 top-3.5" size="20" />
		</BaseInput>

		<BaseInput v-model="user.password_confirmation" label="Confirm Password" placeholder="••••••••" type="password">
			<PhLock class="absolute right-3 top-3.5" size="20" />
		</BaseInput>

		<BaseButton type="submit" label="Register">
			<PhUserCirclePlus size="20" weight="bold" />
		</BaseButton>

		<template #footer>
			<p class="text-center text-sm text-gray-300 mt-10">
				Already have an account?
				<RouterLink to="/login" class="text-fuchsia-400 hover:text-fuchsia-300 font-bold block"
					>Login</RouterLink
				>
			</p>
		</template>
	</AuthCard>
</template>
