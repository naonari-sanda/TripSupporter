<?php

namespace Tests\Feature\Countroller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Image;
use App\Models\User;

class ImageControllerTest extends TestCase
{
    /**
     *
     * @return void
     */

    use RefreshDatabase;

    public function testImageShowFromUserPage()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $user = factory(User::class)->create();
        $image = factory(Image::class)->create([
            'user_id' => $user->id,
            'imgpath' => $file
        ]);

        $response = $this
            ->get(route('user', ['id' => $user->id]));
        $response->assertStatus(302)
            ->assertRedirect('/login');

        $response = $this
            ->actingAs($user)
            ->get(route('user', ['id' => $user->id]));

        $response->assertOk()
            ->assertViewIs('pages.user')
            ->assertViewHas('user');
    }

    public function testImageCreate()
    {
        $this->withoutExceptionHandling();

        Storage::Fake('s3');
        $file = UploadedFile::fake()->image('test.jpg');

        $user = factory(User::class)->create();
        $image = factory(Image::class)->make([
            'user_id' => $user->id,
            'imgpath' => $file
        ]);

        $this->assertDatabaseMissing('images',  ['user_id' => $image->user_id]);

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.img'), $image->toArray());

        $response->assertOk()
            ->assertSessionHas('success_message');

        $this->assertDatabaseHas('images', ['user_id' => $image->user_id]);
    }

    public function testImageDelete()
    {
        $this->withoutExceptionHandling();

        Storage::Fake('s3');
        $file = UploadedFile::fake()->image('test.jpg');
        $fileName = 'public/' . time() . '.' . $file->getClientOriginalName();
        $user = factory(User::class)->create();
        $image = factory(Image::class)->create([
            'user_id' => $user->id,
            'imgpath' => $fileName
        ]);

        $this->assertDatabaseHas('images', ['user_id' => $image->user_id]);

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('delete.img'), $image->toArray());

        $this->assertDatabaseMissing('images',  ['user_id' => $image->user_id]);

        $response->assertStatus(302)
            ->assertSessionHas('success_message')
            ->assertRedirect(route('user', ['id' => $user->id]));
    }
}
