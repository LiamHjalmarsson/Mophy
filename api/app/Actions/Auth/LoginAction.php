<?php 

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAction 
{
    private $request;

    public function __invoke(LoginRequest $request, bool $spa = false): array
    {
        $this->request = $request;

        if ($spa) {
            return $this->loginSession();
        } else {
            return $this->loginToken();
        }
    }

    private function loginToken () {
        $user = User::where('email', $this->request->email)->first();

        if (!$user || !Hash::check($this->request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The credentials provided are incorrect.']
            ]);
        }

        $token = $user->createToken('laravel_api_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    private function loginSession () {
        if (!Auth::attempt($this->request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The credentials provided are incorrect.']
            ]); 
        }

        $this->request->session()->regenerate();

        return [
            'message' => 'Login successful',
            'user' => Auth::user(),
        ];
    }
}
