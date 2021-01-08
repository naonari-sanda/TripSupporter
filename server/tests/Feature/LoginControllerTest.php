<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Country;
use App\Models\Image;
use App\Models\Review;
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
    use RefreshDatabase;


    //ユーザー一覧ページログインチェック
    public function testUserListPageShow()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('user.list'));

        $response->assertOk()
            ->assertViewIs('pages.user_list')
            ->assertViewHas('users')
            ->assertSee('ユーザー');
    }

    //ユーザー詳細ページチェック
    public function testUserDetailpageShow()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('user', ['id' => $user->id]));

        $response->assertOk()
            ->assertViewIs('pages.user')
            ->assertViewHas('user')
            ->assertSee('マイページ');
    }

    //アカウントを作成し指定したページに遷移するかチェック
    public function testCreateAcountTest()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.acount'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('user', ['id' => $user->id]));
    }

    //画像を作成し指定したページに遷移するかチェック
    public function testCreateImgTest()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.img'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('user', ['id' => $user->id]));
    }

    //画像の削除チェック
    public function testDeleteImgTest()
    {
        $user = factory(User::class)->create();


        $response = $this
            ->from(route('user', ['id' => $user->id]))
            ->post(route('delete.img'));

        $response
            ->assertStatus(302);
    }

    //レビュー削除し指定したページに遷移するかチェック
    public function testCreateReviewTest()
    {
        $country = factory(Country::class)->create();
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->from(route('detail', ['id' => $country->id]))
            ->post(route('create.review'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('detail', ['id' => $country->id]));
    }

    public function testDeleteReviewTest()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->from(route('user', ['id' => $user->id]))
            ->post(route('delete.review'));

        $response
            ->assertStatus(302);
    }
}
