import { defineStore } from "pinia";
import { ref } from "vue";
import tmdb from "../../plugins/tmdb";
import type { TMDBGenre, TMDBMovie, TMDBPaginatedResponse, TMDBPerson } from "../../types/tmdb";

export const useTmdbStore = defineStore("tmdb", () => {
	const movies = ref<TMDBMovie[]>([]);

	const trendingMovies = ref<TMDBMovie[]>([]);

	const genres = ref<TMDBGenre[]>([]);

	const trendingTv = ref<TMDBMovie[]>([]);

	const people = ref<TMDBPerson[]>([]);

	const loading = ref(false);

	const error = ref<string | null>(null);

	async function fetchData<T>(endpoint: string): Promise<T | null> {
		try {
			loading.value = true;

			error.value = null;

			const { data } = await tmdb.get<T>(endpoint);

			console.log(data, `fetched data from ${endpoint}`);

			return data;
		} catch (err) {
			console.error(`TMDB fetch failed for ${endpoint}:`, err);

			error.value = "Failed to fetch data from TMDB.";

			return null;
		} finally {
			loading.value = false;
		}
	}

	async function fetchMovies(path: string): Promise<void> {
		const data = await fetchData<TMDBPaginatedResponse<TMDBMovie>>(path);

		if (data?.results) {
			movies.value = data.results;
		}
	}

	async function fetchTrendingMovies() {
		const data = await fetchData<TMDBPaginatedResponse<TMDBMovie>>(`/trending/movie/day`);

		if (data?.results) {
			trendingMovies.value = data.results;
		}
	}

	async function fetchTrendingTv(): Promise<void> {
		const data = await fetchData<TMDBPaginatedResponse<TMDBMovie>>(`/trending/tv/day`);

		if (data?.results) {
			trendingTv.value = data.results;
		}
	}

	async function fetchGenres() {
		const data = await fetchData<TMDBPaginatedResponse<TMDBGenre>>("/genre/movie/list");

		if (data?.results) {
			genres.value = data.results;
		}
	}

	async function fetchPopularPeople(): Promise<void> {
		const data = await fetchData<TMDBPaginatedResponse<TMDBPerson>>(`/person/popular`);

		if (data?.results) {
			people.value = data.results;
		}
	}

	return {
		movies,
		genres,
		people,
		trendingMovies,
		loading,
		error,
		fetchMovies,
		fetchGenres,
		fetchPopularPeople,
		fetchTrendingMovies,
		fetchTrendingTv,
	};
});
