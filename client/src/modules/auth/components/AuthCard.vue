<script setup lang="ts">
import SocialAuth from "./SocialAuth.vue";

defineProps<{
	title?: string;
	subtitle?: string;
}>();

const emit = defineEmits(["submit"]);
</script>

<template>
	<div class="w-full max-w-lg p-2.5 border border-white/20 rounded-2xl">
		<div class="bg-white/10 backdrop-blur-md text-white rounded-xl shadow-2xl p-10 border border-white/20">
			<div class="flex flex-col items-center mb-10">
				<h1 v-if="title" class="text-3xl font-bold text-center">{{ title }}</h1>
				<p v-if="subtitle" class="text-gray-300 text-sm mt-2.5 text-center">{{ subtitle }}</p>
			</div>

			<form @submit.prevent="emit('submit')" class="space-y-10">
				<slot />
			</form>

			<slot name="footer" />

			<SocialAuth />
		</div>
	</div>
</template>
