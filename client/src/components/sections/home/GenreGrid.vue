<script setup lang="ts">
import type { TMDBGenre } from "../../types/tmdb";

defineProps<{ genres: TMDBGenre[] }>();

const colors = [
	"from-teal-500 to-emerald-500",
	"from-indigo-500 to-purple-500",
	"from-rose-500 to-pink-500",
	"from-orange-500 to-amber-400",
	"from-sky-500 to-cyan-400",
	"from-lime-500 to-green-500",
	"from-fuchsia-500 to-violet-500",
	"from-blue-500 to-indigo-400",
	"from-red-500 to-orange-500",
	"from-yellow-400 to-amber-500",
];

const getColor = (index: number) => colors[index % colors.length];
</script>

<template>
	<section>
		<div class="container mx-auto py-10">
			<div class="flex justify-between items-center mb-10">
				<h3 class="font-semibold text-lg">Browse by Category</h3>
				<p class="text-slate-500 text-sm">Data from TMDB</p>
			</div>

			<div v-if="genres.length" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-10">
				<div
					v-for="(genre, index) in genres"
					:key="genre.id"
					:class="[
						`bg-gradient-to-br ${getColor(index)}`,
						'rounded-xl text-white cursor-pointer relative group h-40 flex items-center justify-center transition-all duration-300 overflow-hidden',
					]">
					<span class="font-bold text-lg text-center z-10">
						{{ genre.name }}
					</span>
					<div class="absolute inset-0 bg-black/20 opacity-0 transition"></div>
				</div>
			</div>

			<div v-else class="text-slate-500 text-sm">Loading categories...</div>
		</div>
	</section>
</template>
