export interface ApiError {
	message: string;
	errors?: Record<string, string[]>;
	status?: number;
}

export interface ApiResponse<T> {
	data: T;
	message?: string;
	success?: boolean;
	status?: number;
}

export interface PaginatedResponse<T> {
	page: number;
	results: T[];
	total_pages: number;
	total_results: number;
}
