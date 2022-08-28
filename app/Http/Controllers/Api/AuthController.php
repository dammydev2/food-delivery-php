<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse
    {
        return (new RegisterAction())->execute($request->all());
    }

    public function login(LoginRequest $request)
    {
        return (new LoginAction())->execute($request->all());
    }
}
