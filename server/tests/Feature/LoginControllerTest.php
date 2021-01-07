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

    //ユーザー一覧ページログインチェック


    public function testUserList()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('user.list'));

        $response->assertStatus(200)
            ->assertViewIs('pages.user_list')
            ->assertSee('ユーザー');
    }

    //ユーザー詳細ページチェック
    public function testUserDetail()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('user', ['id' => $user->id]));

        $response->assertStatus(200)
            ->assertViewIs('pages.user')
            ->assertSee('マイページ');
    }

    //アカウントを作成し指定したページに遷移するかチェック
    public function testCreateAcountTest()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.acount'), [
                'user_id' => $user->id,
                'gender' => '男性',
                'age' => '20代〜',
                'profile' => 'test',
                'hobby' => 'test',
                'icon' => 'images.jpg'
            ]);

        $response
            ->assertRedirect(route('user', ['id' => $user->id]));
    }

    //画像を作成し指定したページに遷移するかチェック
    public function testCreateImgTest()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.img'), [
                'user_id' => $user->id,
                'country_id' => 1,
                'imgpath' => 'images.jpg'
            ]);

        $response->assertRedirect(route('user', ['id' => $user->id]));
    }
}
