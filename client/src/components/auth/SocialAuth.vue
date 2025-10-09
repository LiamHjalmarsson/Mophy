<script setup lang="ts">
import { PhGoogleLogo, PhGithubLogo, PhTwitterLogo } from "@phosphor-icons/vue";
import SocialAuthButton from "./SocialAuthButton.vue";
</script>

<template>
	<div class="mt-8">
		<div class="flex items-center justify-center space-x-4 text-sm">
			<span class="w-1/5 border-t border-gray-300" />
			<span>or sign up with</span>
			<span class="w-1/5 border-t border-gray-300" />
		</div>

		<div class="flex justify-center mt-4 space-x-3">
			<SocialAuthButton>
				<PhGoogleLogo size="20" weight="fill" />
			</SocialAuthButton>

			<SocialAuthButton>
				<PhGithubLogo size="20" weight="fill" />
			</SocialAuthButton>

			<SocialAuthButton>
				<PhTwitterLogo size="20" weight="fill" />
			</SocialAuthButton>
		</div>
	</div>
</template>
