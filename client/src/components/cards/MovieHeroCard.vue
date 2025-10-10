<script setup lang="ts">
import type { TMDBMovie } from "../../types/tmdb";
import { buildImageUrl } from "../../utils/tmdb/buildImageUrl";

defineProps<{ movie: TMDBMovie }>();
</script>

<template>
	<div class="py-10 relative w-full min-w-5xl h-full">
		<img
			:src="buildImageUrl(movie.poster_path, 'original')"
			class="object-cover rounded-lg shadow-lg absolute top-0 left-10 h-full w-2/5 overflow-hidden" />
		<div
			class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 shadow-lg p-10 w-full flex rounded-lg h-full">
			<div class="w-2/5"></div>
			<div class="w-3/5 text-right pl-16 text-gray-100">
				<h3 class="text-5xl font-bold">
					{{ movie.title }}
				</h3>
				<div class="mt-5">
					<span class="font-bold">
						{{ movie.release_date }}
					</span>
					<span class="text-lg"> | </span>
					<span class="font-bold"> Genres </span>
					<span class="text-lg"> | </span>
					<span class="font-bold"> type </span>
				</div>
				<div class="flex-1">
					<p class="mt-5 line-clamp-3">
						{{ movie.overview }}
					</p>
				</div>
				<div class="mt-10 space-x-5">
					<button class="bg-rose-500 text-white font-bold py-2 px-8 rounded-full shadow">Watch Later</button>
					<button class="bg-rose-500 text-white font-bold py-2 px-8 rounded-full shadow">Watch Later</button>
				</div>
			</div>
		</div>
	</div>
</template>
