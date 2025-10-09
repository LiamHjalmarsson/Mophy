<script setup lang="ts">
import { computed } from "vue";
import { useAuthStore } from "../../stores/auth";
import UserHome from "./UserHome.vue";
import GuestHome from "./GuestHome.vue";

const auth = useAuthStore();

const isAuthenticated = computed(() => !!auth.user);

console.log("Auth user in Home.vue:", auth.user);
</script>

<template>
	<div>
		<UserHome v-if="isAuthenticated" />
		<GuestHome v-else />
	</div>
</template>
