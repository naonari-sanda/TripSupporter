<?php

namespace Tests\Feature\Countroller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Acount;
use App\Models\User;

class AcountControllerTest extends TestCase
{
    /**
     *
     * @return void
     */

    use RefreshDatabase;


    public function testAcountPageShow()
    {
        $user = factory(User::class)->create();
        $acount = factory(Acount::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this
            ->get(route('user', ['id' => $user->id]));
        $response->assertStatus(302)
            ->assertRedirect('/login');

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->get(route('user', ['id' => $user->id]));

        $response->assertOk()
            ->assertViewIs('pages.user')
            ->assertViewHas('user')
            ->assertSee($acount->profile);
    }

    public function testCreateAcount()
    {
        $this->withoutExceptionHandling();

        Storage::Fake('s3');
        $file = UploadedFile::fake()->image('test.jpg');

        $user = factory(User::class)->create();
        $acount = factory(Acount::class)->make([
            'user_id' => $user->id,
            'icon' => $file
        ]);

        $this->assertDatabaseMissing('acounts', ['profile' => $acount->profile]);

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.acount'), $acount->toArray());

        $this->assertDatabaseHas('acounts', ['profile' => $acount->profile]);

        $response
            ->assertOk()
            ->assertSessionHas('success_message');
    }

    public function testupdateAcount()
    {
        $this->withoutExceptionHandling();

        Storage::Fake('s3');
        $user = factory(User::class)->create();
        $acount = factory(Acount::class)->create([
            'user_id' => $user->id,
            'profile' => 'test_profile'
        ]);

        $this->assertDatabaseHas('acounts', ['profile' => 'test_profile']);

        $acount->profile = 'update_profile';

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('create.acount'), $acount->toArray());

        $response->assertOk()
            ->assertSessionHas('info_message');

        $this->assertDatabaseMissing('acounts', ['profile' => 'test_profile']);
        $this->assertDatabaseHas('acounts', ['profile' => 'update_profile']);
    }

    public function testAcountDelete()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $acount = factory(Acount::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('acounts', ['id' => $acount->id]);

        $response = $this
            ->actingAs($user)
            ->from(route('user', ['id' => $user->id]))
            ->post(route('delete.acount'), $acount->toArray());

        $this->assertDatabaseMissing('acounts', ['id' => $acount->id]);
        $response
            ->assertStatus(302)
            ->assertRedirect(route('user', ['id' => $user->id]))
            ->assertSessionHas('success_message');
    }
}
