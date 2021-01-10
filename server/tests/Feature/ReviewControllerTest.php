<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Review;
use App\Models\User;
use App\Models\Country;

class ReviewControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testReviewController()
    {
        $review = factory(Review::class)->create();
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('reviews', ['review' => $review->review]);

        $review->update([
            'review' => 'change_review'
        ]);
        $this->assertDatabaseHas('reviews', ['review' => 'change_review']);

        $review->delete();
        $this->assertDatabaseMissing('reviews', ['user_id' => $review->review]);
    }

    public function testPostReview()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $country = factory(Country::class)->create();


        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $data = [
            'user_id' => $user->id,
            'country_id' => $country->id,
            'recommend' => 4.3,
            'safe' => 5,
            'cost' => 5,
            'fun' => 4,
            'tourism' => 3,
            'food' => 2,
            'english' => 1,
            'city' => 'testcity',
            'review' => 'test',
            'imgpath' => $file
        ];

        $this->assertDatabaseMissing('reviews', $data);

        $response = $this
            ->actingAs($user)
            ->from(route('detail', ['id' => $country->id]))
            ->post(route('create.review'), $data);

        $this->assertDatabaseHas('reviews', ['country_id' => $country->id]);

        $response
            ->assertStatus(200);
    }
}
