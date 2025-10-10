<script setup lang="ts">
import type { TMDBMovie } from "../../types/tmdb";
import { buildImageUrl } from "../../utils/tmdb/buildImageUrl";

defineProps<{ movie: TMDBMovie }>();
</script>

<template>
	<article
		class="relative rounded-2xl overflow-hidden shadow-md bg-slate-800/60 cursor-pointer ease-in-out flex flex-col justify-end"
		tabindex="0"
		aria-labelledby="movie-title"
		:aria-label="movie.title">
		<img
			:src="buildImageUrl(movie.poster_path, 'w500')"
			:alt="`Poster for ${movie.title}`"
			class="absolute inset-0 w-full h-full object-cover opacity-80"
			loading="lazy" />

		<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-transparent"></div>

		<div class="relative z-10 p-5 text-left">
			<h3 id="movie-title" class="font-bold text-lg leading-tight mb-2.5 line-clamp-2">
				{{ movie.title }}
			</h3>

			<p class="text-sm text-gray-100 mb-5">
				{{ movie.release_date?.split("-")[0] }} • {{ movie.vote_average?.toFixed(1) }} ★
			</p>

			<div class="space-y-5">
				<p class="text-xs text-gray-100 line-clamp-3">
					{{ movie.overview }}
				</p>

				<div class="flex gap-2.5 justify-end mt-10">
					<button class="border border-rose-500 text-rose-500 text-xs font-bold py-2 px-6 rounded-full">
						Details
					</button>
					<button
						class="bg-rose-500 text-white text-xs font-bold py-2 px-6 rounded-full hover:opacity-90 transition-opacity">
						Play
					</button>
				</div>
			</div>
		</div>
	</article>
</template>
