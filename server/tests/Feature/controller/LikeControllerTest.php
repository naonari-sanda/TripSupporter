<?php

namespace Tests\Feature\Countroller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Country;
use App\Models\User;
use App\Models\Like;

class LikeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testLikeCreate()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $country = factory(Country::class)->create();
        
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'country_id' => $country->id]);

        $response = $this
        ->actingAs($user)
        ->from(route('main'))
        ->post('/api/' . $country->id . '/like', ['user_id' => $user->id]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'country_id' => $country->id
            ]);

        $response->assertOk();
    }

    public function testLikeDelete()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $country = factory(Country::class)->create();
        $like = factory(Like::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);
        
        $this->assertDatabaseHas('likes', [
            'user_id' => $like->user_id,
            'country_id' => $like->country_id
            ]);

        $response = $this
        ->actingAs($user)
        ->from(route('main'))
        ->post('/api/' . $country->id . '/unlike', $like->toArray());

        $this->assertDatabaseMissing('likes', [
            'user_id' => $like->user_id,
            'country_id' => $like->country_id
            ]);

        $response->assertOk();
    }
}
