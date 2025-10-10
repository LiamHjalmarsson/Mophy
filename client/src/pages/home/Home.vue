<script setup lang="ts">
import { ref, computed, onMounted } from "vue";
import { useTmdbStore } from "../../stores/tmdb/tmdb";
import MovieHeroCard from "../../components/cards/MovieHeroCard.vue";
import MovieCard from "../../components/cards/MovieCard.vue";
import PersonCard from "../../components/cards/PersonCard.vue";

const tmdbStore = useTmdbStore();

const { fetchMovies, fetchPopularPeople, fetchTrendingMovies, fetchTrendingTv } = tmdbStore;

const activeCategory = ref("top_rated");

const movies = computed(() => tmdbStore.movies);

const moviesTrending = computed(() => tmdbStore.trendingMovies);

const people = computed(() => tmdbStore.people);

onMounted(async () => {
	await fetchMovies(`/movie/${activeCategory.value}`);

	await fetchPopularPeople();

	await fetchTrendingMovies();

	await fetchTrendingTv();
});

async function changeCategory(category: string) {
	if (category === activeCategory.value) {
		return;
	}

	activeCategory.value = category;

	await fetchMovies(`/movie/${category}`);
}
</script>

<template>
	<div class="bg-gradient-to-b from-slate-950 to-slate-900 text-slate-200 min-h-screen">
		<section class="relative flex flex-col justify-center items-center py-20 overflow-hidden h-screen">
			<div class="relative flex items-center justify-center w-full max-w-7xl h-[650px] space-x-10 transition-all">
				<MovieHeroCard
					v-for="(movie, index) in moviesTrending.slice(0, 5)"
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
					<h3 class="font-semibold text-lg pb-5">Movies</h3>

					<div class="flex space-x-10 text-sm font-semibold relative">
						<button
							v-for="category in ['top_rated', 'now_playing', 'upcoming', 'popular']"
							:key="category"
							@click="changeCategory(category)"
							:class="[
								'pb-5 transition-all duration-200 capitalize relative',
								activeCategory === category ? 'text-rose-500' : 'text-slate-500 hover:text-rose-500',
							]">
							{{ category.replace("_", " ") }}
							<span
								v-if="activeCategory === category"
								class="absolute -bottom-1 left-0 w-full h-[2px] bg-rose-500 rounded-full"></span>
						</button>
					</div>
				</div>
			</div>

			<div class="container mx-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-10 py-10" role="list">
				<MovieCard v-for="movie in movies.slice(5, 15)" :key="movie.id" :movie="movie" role="listitem" />
			</div>

			<div>pages</div>
		</section>

		<section class="py-20 border-t border-slate-800">
			<div class="container mx-auto">
				<div class="flex justify-between items-center mb-10">
					<h3 class="font-semibold text-lg">Popular People</h3>
					<p class="text-slate-500 text-sm">Actors & creators trending right now</p>
				</div>

				<div
					v-if="people.length"
					class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-10">
					<PersonCard v-for="person in people.slice(0, 12)" :key="person.id" :person="person" />
				</div>

				<div v-else class="text-gray-500 text-center">Loading popular people...</div>
			</div>
		</section>

		<!-- Extra dont bring wiht -->
		<div>
			<!-- <section class="py-24 border-t border-slate-800">
			<div class="container mx-auto flex flex-col md:flex-row items-center gap-10">
				<img src="/assets/mophy.png" alt="Director" class="w-full md:w-1/3 rounded-xl object-cover shadow-lg" />
				<div class="flex-1">
					<p class="text-emerald-400 text-sm font-medium mb-2">Spotlight Filmmaker</p>
					<h3 class="text-3xl font-bold mb-4">Denis Villeneuve</h3>
					<p class="text-slate-400 text-sm mb-6">
						Known for his visionary storytelling in <em>Dune</em>, <em>Arrival</em> and
						<em>Blade Runner 2049</em>. Villeneuve has redefined modern science fiction cinema.
					</p>
					<button
						class="bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-bold px-6 py-3 rounded-lg">
						View Filmography
					</button>
				</div>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800">
			<div class="container mx-auto">
				<h3 class="font-semibold text-lg mb-10">Top Rated by Genre</h3>
				<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
					<div
						v-for="genre in ['Action', 'Drama', 'Comedy', 'Horror', 'Sci-Fi']"
						:key="genre"
						class="bg-slate-800/60 rounded-xl p-8 text-center hover:bg-slate-700/60 transition-all cursor-pointer">
						<p class="text-white font-semibold mb-2">{{ genre }}</p>
						<p class="text-slate-400 text-sm">Explore best-rated {{ genre.toLowerCase() }} films</p>
					</div>
				</div>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800 text-center">
			<div class="container mx-auto max-w-2xl">
				<p class="text-slate-400 text-sm uppercase tracking-widest mb-3">Film of the Month</p>
				<h3 class="text-3xl font-bold mb-4">
					"Cinema is a mirror that reflects reality and a hammer that shapes it."
				</h3>
				<p class="text-slate-500 text-sm">— Jean-Luc Godard</p>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800">
			<div class="container mx-auto">
				<div class="flex justify-between items-center mb-10">
					<h3 class="font-semibold text-lg">Featured Collections</h3>
					<p class="text-slate-500 text-sm">Curated picks by our editors</p>
				</div>

				<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
					<div
						v-for="set in [
							{ title: 'Oscar Winners', image: '/images/oscar.jpg' },
							{ title: 'Marvel Universe', image: '/images/marvel.jpg' },
							{ title: 'Classic Horror', image: '/images/horror.jpg' },
							{ title: 'Romantic Favorites', image: '/images/romance.jpg' },
							{ title: 'Animated Adventures', image: '/images/animation.jpg' },
						]"
						:key="set.title"
						class="relative h-48 rounded-xl overflow-hidden cursor-pointer group">
						<img
							:src="set.image"
							class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500" />
						<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
						<h4 class="absolute bottom-4 left-5 text-white font-bold text-lg">
							{{ set.title }}
						</h4>
					</div>
				</div>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800 text-center">
			<div class="container mx-auto">
				<h3 class="text-2xl font-bold mb-6">Vote: Best Movie of the Week</h3>
				<div class="flex flex-wrap justify-center gap-6">
					<button class="bg-slate-800/70 hover:bg-slate-700 text-white px-6 py-3 rounded-full transition-all">
						Dune: Part Two
					</button>
					<button class="bg-slate-800/70 hover:bg-slate-700 text-white px-6 py-3 rounded-full transition-all">
						Oppenheimer
					</button>
					<button class="bg-slate-800/70 hover:bg-slate-700 text-white px-6 py-3 rounded-full transition-all">
						John Wick 4
					</button>
					<button class="bg-slate-800/70 hover:bg-slate-700 text-white px-6 py-3 rounded-full transition-all">
						Barbie
					</button>
				</div>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800 text-center">
			<div class="container mx-auto">
				<h3 class="text-2xl font-bold mb-6">Community Highlights</h3>
				<p class="text-slate-400 mb-10 max-w-xl mx-auto">
					See what other film fans are watching, discussing, and recommending this week.
				</p>
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
					<div
						v-for="post in [
							{ user: 'LiamH', text: 'Loved the cinematography in Dune 2 — pure visual poetry.' },
							{
								user: 'MiaFilms',
								text: 'The Batman’s noir atmosphere makes it one of the best reboots ever.',
							},
							{ user: 'FilmGeek', text: 'Oppenheimer’s pacing and dialogue deserve another Oscar run.' },
						]"
						:key="post.user"
						class="bg-slate-800/60 rounded-xl p-6">
						<p class="text-slate-300 text-sm italic mb-3">“{{ post.text }}”</p>
						<p class="text-slate-500 text-xs font-medium">— {{ post.user }}</p>
					</div>
				</div>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800 text-center">
			<div class="container mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
				<div>
					<h4 class="text-3xl font-bold text-white">50K+</h4>
					<p class="text-slate-400 text-sm">Movies Indexed</p>
				</div>
				<div>
					<h4 class="text-3xl font-bold text-white">15K+</h4>
					<p class="text-slate-400 text-sm">Actors Listed</p>
				</div>
				<div>
					<h4 class="text-3xl font-bold text-white">1200+</h4>
					<p class="text-slate-400 text-sm">Collections Curated</p>
				</div>
				<div>
					<h4 class="text-3xl font-bold text-white">10+</h4>
					<p class="text-slate-400 text-sm">Years of Data</p>
				</div>
			</div>
		</section>

		<section class="relative h-[400px] border-t border-slate-800 overflow-hidden">
			<img src="/assets/mophy.png" class="absolute inset-0 w-full h-full object-cover opacity-70" />
			<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent"></div>
			<div class="absolute inset-0 flex flex-col items-center justify-center text-center">
				<h3 class="text-3xl font-bold mb-4 text-white">Watch the Latest Trailers</h3>
				<button
					class="bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-bold px-8 py-3 rounded-full">
					Play Now
				</button>
			</div>
		</section>

		<section class="py-20 border-t border-slate-800 text-center">
			<div class="container mx-auto">
				<h3 class="text-3xl font-bold mb-5">Join our movie community</h3>
				<p class="text-gray-400 max-w-xl mx-auto mb-5">
					Get weekly updates about trending films, top picks, and behind-the-scenes news.
				</p>
				<form class="flex justify-center gap-5 max-w-md mx-auto">
					<input
						type="email"
						placeholder="Enter your email"
						class="flex-1 bg-slate-800 border border-slate-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-rose-500" />
					<button type="submit" class="bg-rose-500 text-white font-bold px-6 py-3 rounded-lg">
						Subscribe
					</button>
				</form>
			</div>
		</section> -->
		</div>
	</div>
</template>
