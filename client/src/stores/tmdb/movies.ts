import { defineStore } from "pinia";
import { ref } from "vue";
import tmdb from "../../plugins/tmdb";
import type { TMDBGenre, TMDBMovie, TMDBPaginatedResponse } from "../../types/tmdb";

export const useMoviesStore = defineStore("movies", () => {
	const trending = ref<TMDBMovie[]>([]);

	const genres = ref<TMDBGenre[]>([]);

	const loading = ref(false);

	const error = ref<string | null>(null);

	async function fetchTopRated(): Promise<void> {
		try {
			loading.value = true;

			error.value = null;

			const { data } = await tmdb.get<TMDBPaginatedResponse<TMDBMovie>>("/movie/top_rated");

			trending.value = data.results;
		} catch (err) {
			error.value = "Failed to fetch trending movies.";
		} finally {
			loading.value = false;
		}
	}

	async function fetchGenres(): Promise<void> {
		try {
			const { data } = await tmdb.get<{ genres: TMDBGenre[] }>("/genre/movie/list");

			genres.value = data.genres;
		} catch {
			error.value = "Failed to fetch genres.";
		}
	}

	return { trending, genres, loading, error, fetchTopRated, fetchGenres };
});
