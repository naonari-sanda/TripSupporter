<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    public function testUserList()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('user.list'));

        // $response = $this->get('/');

        //ユーザー一覧ページログインチェック
        $response->assertStatus(200)
            ->assertViewIs('pages.user_list')
            ->assertSee('ユーザー');
    }

    public function testUserDetail()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('user', ['id' => $user->id]));

        $response->assertStatus(200)
            ->assertViewIs('pages.user');
    }
}
