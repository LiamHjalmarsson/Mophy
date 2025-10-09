<script setup lang="ts">
import { useRouter, RouterLink } from "vue-router";
import { PhUserCircle, PhSignOut } from "@phosphor-icons/vue";
</script>

<template>
	<nav class="sticky top-0 z-50 backdrop-blur-md bg-white/70 border-b border-gray-200 shadow-sm">
		<div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
			<RouterLink to="/" class="flex items-center gap-2 font-extrabold text-xl text-blue-600">
				<span>MovieApp</span>
			</RouterLink>

			<div class="flex items-center gap-6">
				<RouterLink to="/" class="font-medium text-gray-700 hover:text-blue-600 transition"> Home </RouterLink>
			</div>
		</div>
	</nav>
</template>
