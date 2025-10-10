<script setup lang="ts">
import { useMoviesStore } from "../../stores/tmdb/movies";
import MovieHeroCard from "../../components/card/MovieHeroCard.vue";
import MovieCard from "../../components/card/MovieCard.vue";

const { fetchTopRated, trending } = useMoviesStore();

fetchTopRated();
</script>

<template>
	<div class="bg-gradient-to-b from-slate-950 to-slate-900 text-slate-200">
		<section class="relative flex flex-col justify-center items-center py-20 overflow-hidden h-screen">
			<div class="relative flex items-center justify-center w-full max-w-7xl h-[650px] space-x-10">
				<MovieHeroCard
					v-for="(movie, index) in trending.slice(0, 5)"
					:key="movie.id"
					:movie="movie"
					:class="[
						'transition-all duration-500',
						index === 2 ? 'scale-100 z-30 w-[400px]' : 'scale-90 w-[300px] opacity-60',
					]" />
			</div>
		</section>

		<section>
			<div class="container mx-auto border-b border-slate-700">
				<div class="flex justify-between items-center">
					<h3 class="font-semibold text-lg pb-4">Popular Movies</h3>

					<div class="flex space-x-10 text-sm font-semibold relative">
						<p class="text-emerald-500 relative group pb-5">
							Action
							<span class="absolute bottom-0 left-0 w-full h-[2px] bg-emerald-500 rounded-full"></span>
						</p>
						<p class="text-slate-500 hover:text-emerald-400 cursor-pointer pb-5">Romance</p>
						<p class="text-slate-500 hover:text-emerald-400 cursor-pointer pb-5">Horror</p>
						<p class="text-slate-500 hover:text-emerald-400 cursor-pointer pb-5">Comedy</p>
					</div>
				</div>
			</div>

			<div class="container mx-auto grid grid-cols-5 gap-10 py-10" role="list">
				<MovieCard v-for="movie in trending.slice(5, 15)" :key="movie.id" :movie="movie" role="listitem" />
			</div>
		</section>
	</div>
</template>
