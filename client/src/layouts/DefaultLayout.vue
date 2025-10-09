<script setup lang="ts"></script>

<template>
	<div class="min-h-screen bg-gray-50">
		<nav class="bg-white shadow p-4 flex justify-between">
			<RouterLink to="/" class="font-bold">MovieApp</RouterLink>
			<div class="space-x-4">
				<RouterLink to="/login" class="text-gray-700 hover:text-blue-600">Login</RouterLink>
				<RouterLink to="/register" class="text-gray-700 hover:text-blue-600">Register</RouterLink>
			</div>
		</nav>

		<main class="p-6">
			<RouterView />
		</main>
	</div>
</template>
