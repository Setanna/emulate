<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        // create the user
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role_id' => 1,
            'password' => Hash::make($request->input('password'))
        ]);

        // login (If token and session is created within register, the session fails in being created, so call login instead)
        return $this->login($request);
    }

    public function login(Request $request)
    {
        if (!\Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Login information is invalid.'
            ], 401);
        }

        // get user
        $user = User::where('username', $request['username'])->firstOrFail();

        // get current time and add an hour
        $expirationsDate = Carbon::now()->addHour();

        // create abilities based on user role
        $abilities = match ($user->role->name) {
            'user' => ['change password', 'change email', 'password reset', 'read'],
            'moderator' => ['change password', 'change email', 'password reset', 'read', 'create', 'read', 'update', 'destroy'],
            'admin' => ['change password', 'change email', 'password reset', 'read', 'create', 'read', 'update', 'destroy', 'update user role'],
            default => [],
        };

        // create token with the given abilities
        $token = $user->createToken('authToken', $abilities, $expirationsDate)->plainTextToken;

        return response()->json([
            'Login information is valid.'
        ]);
    }

    public function logout(Request $request)
    {
        if(auth('sanctum')->check() ) {
            return Auth::logout();
        }else {
            return response()->json([
                'No user logged in.'
            ]);
        }
    }

    public function checkAbility(Request $request, $ability)
    {
        if (auth('sanctum')->check()) {
            // return $request->user('sanctum')->currentAccessToken()->tokenCan($ability);

            $user = $request->user('sanctum');
            $token = $user->tokens()->first();
            $abilities = $token->abilities;

            // return $ability;
            // return $abilities;
            if (in_array($ability, $abilities)) {
                return response()->json(
                    true
                );
            }
            return response()->json(
                false
            );
        } else {
            return response()->json([
                'Unauthenticated',
            ], 403);
        }
    }
}
