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
}

export interface TMDBGenre {
	id: number;
	name: string;
}

export interface TMDBPaginatedResponse<T> {
	page: number;
	results: T[];
	total_pages: number;
	total_results: number;
}
