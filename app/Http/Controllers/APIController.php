<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrensiesRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\CurrencyResourceCollection;
use App\Http\Resources\UserTokenResource;
use App\Models\Currency;
use App\Models\User;


class APIController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $token = User::getToken($data['login'], $data['password']);

        return new UserTokenResource($token);
    }

    public function currencies(CurrensiesRequest $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);

        $currencies = Currency::query()
            ->select('id', 'char_code', 'name', 'rate', 'date')
            ->paginate($perPage, ['*'], 'page', $page);

        return new CurrencyResourceCollection($currencies);
    }

    public function currency(Currency $currency)
    {
        return new CurrencyResource($currency);
    }
}
