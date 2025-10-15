export interface RegisterPayload {
	email: string;
	username: string;
	password: string;
	password_confirmation: string;
}

export interface LoginPayload {
	email: string;
	password: string;
}

export interface AuthUser {
	id: number;
	name?: string;
	username: string;
	email: string;
	avatar?: string | null;
}

export interface AuthResponse {
	user: AuthUser;
	token: string;
}
