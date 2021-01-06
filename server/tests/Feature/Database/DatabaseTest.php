<?php

namespace Tests\Feature\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testDatabase()
    {
        $this->assertTrue(
            Schema::hasColumns('likes', [
                'id', 'user_id', 'country_id',
            ]),
            1
        );
    }
}
