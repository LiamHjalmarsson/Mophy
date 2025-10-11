import type { AxiosError } from "axios";
import type { ApiError } from "../types/api";

export function handleApiError(error: AxiosError<ApiError> | Error): ApiError {
	if (isAxiosErrorWithApiError(error)) {
		const response = error.response;

		return {
			message: response?.data?.message ?? error.message ?? "An unexpected error occurred.",
			errors: response?.data?.errors,
			status: response?.status,
		};
	}

	return {
		message: error.message || "Unexpected internal error",
	};
}

function isAxiosErrorWithApiError(error: AxiosError<ApiError> | Error): error is AxiosError<ApiError> {
	return (error as AxiosError).isAxiosError === true;
}
