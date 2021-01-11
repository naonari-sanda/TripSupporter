<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;


    //ユーザー一覧ページログインチェック
    public function testUserListPageShow()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->get(route('user.list'));
        $response->assertStatus(302)
            ->assertRedirect('/login');

        $response = $this
            ->actingAs($user)
            ->get(route('user.list'));

        $response->assertOk()
            ->assertViewIs('pages.user_list')
            ->assertViewHas('users')
            ->assertSee('ユーザー');
    }

    //ユーザー詳細ページチェック
    public function testUserDetailPageShow()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->get(route('user', ['id' => $user->id]));
        $response->assertStatus(302)
            ->assertRedirect('/login');

        $response = $this
            ->actingAs($user)
            ->get(route('user', ['id' => $user->id]));

        $response->assertOk()
            ->assertViewIs('pages.user')
            ->assertViewHas('user')
            ->assertSee('マイページ');
    }
}
