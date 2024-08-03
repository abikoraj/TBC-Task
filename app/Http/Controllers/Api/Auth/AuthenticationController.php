<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json(['success' => true, 'message' => 'Account created. Login to proceed'], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $user = auth()->user();


        // access token -> laravel passport
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = now()->addMonth(1);
        $token->save();


        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully.',
            'user_id' => $tokenResult->token->user_id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expire_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ], 200);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json([
            'success' => true,
            'message' => 'Successfully Logged Out.'
        ]);
    }
}
