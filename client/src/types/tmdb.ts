export interface TMDBMovie {
	id: number;
	title: string;
	original_title: string;
	original_language: string;
	overview: string;
	poster_path: string | null;
	backdrop_path: string | null;
	release_date: string;
	vote_average: number;
	vote_count: number;
	video: boolean;
	adult: boolean;
	popularity: number;
	genre_ids?: number[];
	media_type?: string;
}

export interface TMDBGenre {
	id: number;
	name: string;
}

export interface TMDBPerson {
	gender: number;
	id: number;
	known_for: {
		backdrop_path: string;
		first_air_date: string;
		genre_ids: number[];
		id: number;
		media_type: string;
		name: string;
		origin_country: string[];
		original_language: string;
		original_name: string;
		overview: string;
		popularity: number;
		poster_path: string;
		vote_average: number;
		vote_count: number;
	}[];
	known_for_department: string;
	name: string;
	original_name: string;
	popularity: number;
	profile_path: string;
}

export interface TMDBPaginatedResponse<T> {
	page: number;
	results: T[];
	total_pages: number;
	total_results: number;
}
