<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserTokenResource;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $token = User::getToken($data['login'], $data['password']);

        return new UserTokenResource($token);
    }

    public function getCurrencies()
    {

    }

    public function getCurrency()
    {

    }
}
