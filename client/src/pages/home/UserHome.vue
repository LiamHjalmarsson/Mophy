<script setup lang="ts">
import { useRouter } from "vue-router";
import { useAuthStore } from "../../stores/auth";

const router = useRouter();

const auth = useAuthStore();

function goToDashboard(): void {
	router.push("/dashboard");
}
</script>

<template>
	<section class="min-h-[80vh] flex flex-col justify-center items-center text-center px-6 bg-gray-50 text-gray-800">
		<h1 class="text-4xl font-bold mb-4">Welcome back, {{ auth.user?.name }}!</h1>
		<p class="text-lg text-gray-600 mb-8 max-w-2xl">Your movie stats, reviews, and recommendations are waiting.</p>
		<button
			@click="goToDashboard"
			class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition">
			Go to Dashboard
		</button>
	</section>
</template>
