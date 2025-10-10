<script setup lang="ts">
import MainNavigation from "../components/layout/MainNavigation.vue";
</script>

<template>
	<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">
		<MainNavigation />

		<main class="">
			<RouterView />
		</main>
	</div>
</template>
