<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password, [])) {
                return response([
                    'code'    => 401,
                    'success' => false,
                    'message' => 'Bad credentials'
                ], 401);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'code'         => 200,
                'success'      => true,
                'access_token' => $tokenResult,
                'token_type'   => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'code'    => 500,
                'success' => true,
                'message' => 'Error in Login',
                'error'   => $error,
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'description', 'email', 'password']);

        $data['password'] = bcrypt($data['password']);

        try {
            $user = User::create($data);

            event(new Registered($user));

            return response()->json([
                'code'    => 200,
                'success' => true,
                'message' => 'Registered successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code'    => 500,
                'success' => false,
                'message' => 'error registration',
                'errors'  => $exception
            ]);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return response()->json([
                'code'    => 200,
                'success' => true,
                'message' => 'Logged out'
            ]);
        } else {
            return response()->json([
                'code'    => 500,
                'success' => false,
                'message' => 'Error logout'
            ], 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        Auth::user()->update(['password' => bcrypt($request->password)]);

        Auth::user()->tokens()->delete();

        return response()->json([
            'code'    => 200,
            'success' => true,
            'message' => 'Change password successfully'
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'file', 'image']
        ]);
        try {
            $url = Str::start($request->file('avatar')->store('public/avatars'), 'public/');
            $url = Str::start(Str::substr($url, Str::length('public/')), 'storage/');
            $url = url($url);
        } catch (\Exception $exception) {
            return response()->json([
                'code'    => 500,
                'success' => false,
                'message' => 'error upload',
                'errors'  => $exception
            ]);
        }

        return response()->json([
            'code'    => 200,
            'success' => true,
            'message' => 'Upload avatar successfully',
            'url'     => $url
        ]);

    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = $request->only(['name', 'description']);

        Auth::user()->update($data);

        return new UserResource(Auth::user());
    }

    public function currentUser(Request $request)
    {
        return new UserResource($request->user());
    }
}
