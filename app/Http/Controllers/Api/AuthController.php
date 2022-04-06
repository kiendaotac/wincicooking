<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email'    => 'email|required',
                'password' => 'required'
            ]);

            $credentials = $request->only(['email', 'password']);

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password, [])) {
                return response([
                    'message' => 'Bad credentials'
                ], 401);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'code'         => 200,
                'access_token' => $tokenResult,
                'token_type'   => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'code'    => 500,
                'message' => 'Error in Login',
                'error'   => $error,
            ]);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return response()->json([
                'code'    => 200,
                'message' => 'Logged out'
            ]);
        } else {
            return response()->json([
                'code'    => 500,
                'message' => 'Error logout'
            ], 500);
        }
    }

    public function currentUser(Request $request){
        return new UserResource($request->user());
    }
}
