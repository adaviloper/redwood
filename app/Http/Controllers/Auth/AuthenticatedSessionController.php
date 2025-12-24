<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function username()
    {
        return 'username';
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $user = $request->user();
            $permissions = $user->getAllPermissions();

            $userResponse = $user->toArray();
            data_set($userResponse, 'permissions', $permissions);

            return response([
                'user' => $userResponse,
                'token' => $user->createToken("{$user->email}-auth-token")->plainTextToken,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
