<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "../../stores/auth";

const auth = useAuthStore();

const stats = ref([
	{ title: "Movies Watched", value: 42 },
	{ title: "Reviews Written", value: 12 },
	{ title: "Followers", value: 8 },
]);
</script>

<template>
	<div class="min-h-screen bg-gray-50 text-gray-800">
		<main class="max-w-6xl mx-auto p-6 space-y-10">
			<section>
				<h2 class="text-xl font-semibold mb-4">Quick Stats</h2>
				<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
					<div
						v-for="stat in stats"
						:key="stat.title"
						class="bg-white rounded-xl shadow p-6 text-center border border-gray-100">
						<p class="text-sm text-gray-500">{{ stat.title }}</p>
						<p class="text-3xl font-bold mt-2">{{ stat.value }}</p>
					</div>
				</div>
			</section>

			<section>
				<h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
				<div class="bg-white rounded-xl shadow p-6 text-gray-700">
					<p>No recent activity yet.</p>
				</div>
			</section>
		</main>
	</div>
</template>
