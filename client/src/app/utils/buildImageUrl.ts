export function buildImageUrl(path: string | null, size: "w200" | "w500" | "original" = "w500"): string {
	if (!path) {
		return "/placeholder.jpg";
	}

	return `https://image.tmdb.org/t/p/${size}${path}`;
}
