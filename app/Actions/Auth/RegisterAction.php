<?php

namespace App\Actions\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class RegisterAction
{
    use ResponseTrait;
    private $data;
    private $user;

    public function execute(array $data)
    {
        $this->data = $data;
        return $this->createUser();
    }

    private function createUser()
    {
        $this->user = User::create([
            'uid' => Str::orderedUuid(),
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password'])
        ]);

        $this->createWallet();
        $token = $this->user->createToken("API TOKEN")->plainTextToken;

        return $this->success(['token' => $token, 'user_data' => new UserResource($this->user)]);
    }

    public function createWallet()
    {
        return Wallet::create([
            'uid' => Str::orderedUuid(),
            'user_id' => $this->user->id
        ]);
    }
}
