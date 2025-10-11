import axios, { type AxiosInstance } from "axios";

const TMDB_BASE_URL = import.meta.env.VITE_TMDB_BASE_URL || "https://api.themoviedb.org/3";

const TMDB_API_KEY = import.meta.env.VITE_TMDB_API_KEY;

if (!TMDB_API_KEY) {
	console.warn("⚠️ Missing TMDB API key. Add VITE_TMDB_API_KEY in your .env file.");
}

const tmdb: AxiosInstance = axios.create({
	baseURL: TMDB_BASE_URL,
	params: {
		api_key: TMDB_API_KEY,
		language: "en-US",
	},
});

export default tmdb;
