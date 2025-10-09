<script setup lang="ts">
import { PhUser, PhLock, PhEnvelope, PhUserCirclePlus } from "@phosphor-icons/vue";
import SocialAuth from "../../components/auth/SocialAuth.vue";
import BaseInput from "../../components/ui/BaseInput.vue";
import BaseButton from "../../components/ui/BaseButton.vue";
</script>

<template>
	<div class="w-full max-w-lg p-2 border border-white/20 rounded-2xl">
		<div class="bg-white/10 backdrop-blur-md text-white rounded-xl shadow-2xl p-8 border border-white/20">
			<div class="flex flex-col items-center mb-8">
				<h1 class="text-3xl font-bold text-center">Create Account</h1>
				<p class="text-gray-300 text-sm mt-2">Join our community and get started today</p>
			</div>

			<form class="space-y-10">
				<BaseInput label="Full Name" placeholder="John Doe">
					<PhUser class="absolute right-3 top-3.5 text-gray-400" size="20" />
				</BaseInput>

				<BaseInput label="Email" placeholder="you@example.com" type="email">
					<PhEnvelope class="absolute right-3 top-3.5 text-gray-400" size="20" />
				</BaseInput>

				<BaseInput label="Password" placeholder="••••••••" type="password">
					<PhLock class="absolute right-3 top-3.5 text-gray-400" size="20" />
				</BaseInput>

				<BaseInput label="Confirm Password" placeholder="••••••••" type="password">
					<PhLock class="absolute right-3 top-3.5 text-gray-400" size="20" />
				</BaseInput>

				<BaseButton type="submit" label="Register">
					<PhUserCirclePlus size="20" weight="bold" />
				</BaseButton>
			</form>

			<p class="text-center text-sm text-gray-300 mt-6">
				Already have an account?
				<RouterLink to="/login" class="block text-blue-400 hover:text-blue-300 font-bold">Login</RouterLink>
			</p>

			<SocialAuth />
		</div>
	</div>
</template>
