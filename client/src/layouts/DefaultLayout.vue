<script setup lang="ts">
import { computed } from "vue";
import { useRouter, RouterLink } from "vue-router";
import { PhUserCircle, PhSignOut } from "@phosphor-icons/vue";
import { useAuthStore } from "../stores/auth";
import MainNavigation from "../components/navigaion/MainNavigation.vue";

const router = useRouter();

const auth = useAuthStore();

const isAuthenticated = computed(() => !!auth.user);

function handleLogout() {
	localStorage.removeItem("token");

	auth.user = null;

	router.push("/");
}
</script>

<template>
	<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">
		<MainNavigation />

		<main class="">
			<RouterView />
		</main>
	</div>
</template>
