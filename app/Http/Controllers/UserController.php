<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRequest $request)
    {
        $user = $this->userService->save([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'user' => $user
        ],201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        $token = $this->userService->login($credentials);

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'email or password is wrong',
            ],401);
        }

        return new UserResource(true, 'Success', $token);
    }
}
