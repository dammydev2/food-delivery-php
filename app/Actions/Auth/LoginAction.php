<?php

namespace App\Actions\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class LoginAction
{
    use ResponseTrait;
    private $data;
    private $user;

    public function execute(array $data)
    {
        $this->data = $data;
        return $this->LoginUser();
    }

    private function LoginUser()
    {
        if (!Auth::attempt($this->data)) {
            return $this->error('Email & Password does not match with our record.', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'user' => new UserResource(auth()->user())
        ], 'login successful');
    }
}
