<script setup lang="ts">
import type { TMDBPerson } from "../../types/tmdb";

defineProps<{ person: TMDBPerson }>();
</script>

<template>
	<article class="relative group rounded-xl overflow-hidden bg-slate-800/60 shadow-md cursor-pointer h-64">
		<img
			v-if="person.profile_path"
			:src="`https://image.tmdb.org/t/p/w500${person.profile_path}`"
			:alt="person.name"
			class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-700" />
		<div v-else class="absolute inset-0 flex items-center justify-center bg-slate-700 text-slate-400 text-sm">
			No Image
		</div>

		<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

		<div class="relative z-10 p-5 flex flex-col justify-end h-full">
			<h4 class="font-semibold text-white text-base leading-tight line-clamp-1">
				{{ person.name }}
			</h4>
			<p class="text-slate-300 text-xs mt-1 line-clamp-1">
				{{ person.known_for_department }}
			</p>
		</div>
	</article>
</template>
