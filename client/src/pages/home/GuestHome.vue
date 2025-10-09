<script setup lang="ts">
import { useRouter } from "vue-router";

const router = useRouter();

function handleGetStarted(): void {
	router.push("/auth/register");
}
</script>

<template>
	<section
		class="min-h-[80vh] flex flex-col justify-center items-center text-center px-6 bg-gradient-to-br from-blue-600 via-indigo-500 to-purple-600 text-white">
		<h1 class="text-5xl font-bold mb-4">Welcome to MovieApp</h1>
		<p class="text-lg text-white/80 mb-8 max-w-2xl">
			Track your favorite movies, rate and review them, and connect with a community of film lovers.
		</p>
		<button
			@click="handleGetStarted"
			class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition">
			Get Started
		</button>
	</section>
</template>
