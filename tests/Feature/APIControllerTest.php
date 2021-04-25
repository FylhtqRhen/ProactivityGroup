<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class APIControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $token = User::query()
            ->select('token')
            ->where('name' , '=', 'root')
            ->where('password', '=', Hash::make(env('USER_PASSWORD')))
            ->first();

        $response = $this->post('/api/login/', ['login' => 'root', 'password' => 'root']);
        $response->assertStatus(200);
        $response->assertSee($token);
    }

    public function test_currencies()
    {
        $currencies = Currency::query()
            ->select('id', 'char_code', 'name', 'rate', 'date')
            ->paginate(null, ['*'], 'page', null);

        $response = $this->get('/api/currencies/', ['Authorization' => 'amRxhAAa0swtn6S5oMtS4rTtBuQgUyWZ']);
        $response->assertStatus(200);
        $response->json($currencies);
    }

    public function test_currency()
    {
        $currency = Currency::query()
            ->where('id', '=', '1')
            ->first();

        $response = $this->get('/api/currencies/1/', ['Authorization' => 'amRxhAAa0swtn6S5oMtS4rTtBuQgUyWZ']);
        $response->assertStatus(200);
        $response->json($currency);
    }
}
