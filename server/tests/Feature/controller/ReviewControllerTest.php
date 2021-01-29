<?php

namespace Tests\Feature\Countroller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Review;
use App\Models\User;
use App\Models\Country;

class ReviewControllerTest extends TestCase
{
    /**
     *
     * @return void
     */

    use RefreshDatabase;

    public function testReviewindex()
    {
        $country = factory(Country::class)->create();
        $review = factory(Review::class)->create([
            'country_id' => $country->id,
        ]);

        $response = $this->get(route('detail', ['id' => 0]))
            ->assertStatus(404);

        $response = $this->get(route('detail', ['id' => $country->id]));

        $response->assertOk()
            ->assertViewIs('pages.detail')
            ->assertViewHas('country')
            ->assertSee($review->review);
    }

    public function testReviewCreate()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $country = factory(Country::class)->create();

        Storage::Fake('s3');
        $file = UploadedFile::fake()->image('test.jpg');

        $review = factory(Review::class)->make([
            'user_id' => $user->id,
            'country_id' => $country->id,
            'imgpath' => $file,
        ]);

        $this->assertDatabaseMissing('reviews', ['review' => $review->review]);

        $response = $this
            ->actingAs($user)
            ->from(route('detail', ['id' => $country->id]))
            ->post(route('create.review'), $review->toArray());

        $this->assertDatabaseHas('reviews', ['review' => $review->review]);
        $response->assertOk();
    }

    public function testReviewUpdate()
    {
        $this->withoutExceptionHandling();

        Storage::Fake('s3');
        $user = factory(User::class)->create();
        $country = factory(Country::class)->create();
        $review = factory(Review::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id,
            'review' => 'test.text',
        ]);

        $this->assertDatabaseHas('reviews', ['review' => 'test.text']);

        $review->review = 'change_text';

        $response = $this
            ->actingAs($user)
            ->from(route('detail', ['id' => $country->id]))
            ->post(route('create.review'), $review->toArray());

        $response->assertOk();

        $this->assertDatabaseHas('reviews', ['review' => 'change_text']);
    }

    public function testReviewDelete()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $review = factory(Review::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('reviews', ['review' => $review->review]);

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('delete.review'), $review->toArray());

        $this->assertDatabaseMissing('reviews', ['review' => $review->review]);

        $response->assertStatus(302)
            ->assertRedirect(route('user', ['id' => $user->id]));
    }
}
