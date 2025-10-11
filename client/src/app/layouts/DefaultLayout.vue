<script setup lang="ts">
import MainNavigation from "@shared/components/layout/MainNavigation.vue";
</script>

<template>
	<div class="min-h-screen">
		<MainNavigation />

		<main class="">
			<RouterView />
		</main>
	</div>
</template>
