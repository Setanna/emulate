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
    public function register(UserRequest $request){
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        // login (If token and session is created within register, the session fails in being created, so call login instead)
        return $this->login($request);
    }

    public function login(Request $request){
        if (!\Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Login information is invalid.'
            ], 401);
        }

        // get user
        $user = User::where('username', $request['username'])->firstOrFail();

        // get current time and add an hour
        $expirationsDate = Carbon::now()->addHour();

        // create a token
        $token = $user->createToken('authToken', ['change password', 'change email', 'password reset', 'read'], $expirationsDate)->plainTextToken;

        // create session
        $request->session()->regenerate();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request){
        $request->session()->invalidate();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
