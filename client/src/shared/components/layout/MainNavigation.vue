<script setup lang="ts">
import { computed, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/modules/auth/stores/auth";
import { PhUser, PhMagnifyingGlass, PhHouse, PhSignOut, PhGear } from "@phosphor-icons/vue";

const router = useRouter();

const authStore = useAuthStore();

const showMenu = ref(false);

const isAuthenticated = computed(() => authStore.user !== null);

function toggleMenu() {
	showMenu.value = !showMenu.value;
}

async function handleLogout(): Promise<void> {
	localStorage.removeItem("token");

	authStore.user = null;

	await router.push({ name: "home" });
}
</script>

<template>
	<nav class="fixed top-0 z-50 w-full bg-slate-900 text-slate-100">
		<div class="max-w-7xl mx-auto flex items-center justify-between px-10 text-gray-900">
			<div class="flex items-center">
				<div v-if="isAuthenticated">
					<button
						@click="toggleMenu"
						class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 border border-gray-200 transition-all text-gray-800">
						<PhUser size="24" weight="bold" />
					</button>

					<div class="relative">
						<transition
							enter-active-class="transition ease-out duration-200"
							enter-from-class="opacity-0 -translate-y-10"
							enter-to-class="opacity-100 -translate-y-0"
							leave-active-class="transition ease-in duration-150"
							leave-from-class="opacity-100 translate-y-0"
							leave-to-class="opacity-0 -translate-y-2">
							<div
								v-if="showMenu"
								class="absolute mt-3 left-0 w-56 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">
								<div class="px-4 py-3 border-b border-gray-100">
									<p class="text-sm font-semibold text-gray-900">{{ authStore.user?.name }}</p>

									<p class="text-xs text-gray-500 truncate">{{ authStore.user?.email }}</p>
								</div>

								<div class="py-2 text-sm">
									<RouterLink
										to="/dashboard"
										class="flex items-center gap-2 px-4 py-2 text-gray-500 hover:bg-gray-50 transition-colors"
										@click="showMenu = false">
										<PhHouse size="18" /> Dashboard
									</RouterLink>

									<RouterLink
										to="/profile"
										class="flex items-center gap-2 px-4 py-2 text-gray-500 hover:bg-gray-50 transition-colors"
										@click="showMenu = false">
										<PhGear size="18" /> Profile
									</RouterLink>

									<button
										@click="handleLogout"
										class="flex items-center w-full gap-2 px-4 py-2 text-gray-500 hover:bg-red-50 hover:text-red-500 transition-colors">
										<PhSignOut size="18" /> Logout
									</button>
								</div>
							</div>
						</transition>
					</div>
				</div>

				<RouterLink
					v-else
					to="/login"
					class="p-2 rounded-xl bg-gray-700 hover:bg-gray-600 border border-gray-600 transition-all text-gray-300">
					<PhUser size="24" weight="bold" />
				</RouterLink>
			</div>

			<div class="flex items-stretch h-full">
				<RouterLink
					to="/"
					class="flex justify-center items-center text-gray-500 font-semibold hover:bg-rose-500 transition-colors px-8"
					active-class="bg-rose-500 text-slate-100"
					>Popular</RouterLink
				>
				<RouterLink
					to="/discover"
					class="flex justify-center items-center text-gray-500 font-semibold hover:bg-fuchsia-50 transition-colors px-8"
					active-class="bg-rose-500 text-slate-100"
					>Upcoming</RouterLink
				>

				<RouterLink to="/" class="">
					<img src="/assets/mophy.png" class="h-20 w-20 object-contain" />
				</RouterLink>

				<RouterLink
					to="/trending"
					class="flex justify-center items-center text-gray-500 font-semibold hover:bg-fuchsia-50 transition-colors px-8"
					active-class="bg-rose-500 text-slate-100"
					>Top</RouterLink
				>
				<RouterLink
					to="/genres"
					class="flex justify-center items-center text-gray-500 font-semibold hover:bg-fuchsia-50 transition-colors px-8"
					active-class="bg-rose-500 text-slate-100"
					>Genres</RouterLink
				>
			</div>

			<div class="flex items-center">
				<button
					class="p-2 rounded-xl bg-gray-700 hover:bg-gray-600 border border-gray-600 transition-all text-gray-300"
					@click="router.push('/search')">
					<PhMagnifyingGlass size="24" weight="bold" />
				</button>
			</div>
		</div>
	</nav>
</template>
