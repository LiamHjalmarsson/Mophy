<?php 

namespace App\Actions\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterAction 
{
    public function __invoke(RegisterRequest $request, bool $spa = false)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($spa) {
            Auth::login($user);

            $request->session()->regenerate();

            return ['message' => 'Registration successful', 'user' => $user];
        } else {
            $token = $user->createToken('laravel_api_token')->plainTextToken;
            
            return ['token' => $token, 'user' => $user];
        }
    }
}
