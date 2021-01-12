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
    public function testDatabaseUsers()
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id',
                'name',
                'email',
                'email_verified_at',
                'password',
                'remember_token',
                'created_at',
                'updated_at'
            ]),
            1
        );
    }

    public function testDatabaseCountries()
    {
        $this->assertTrue(
            Schema::hasColumns('countries', [
                'id', 
                'name',
                'imgpath',
                'area',
                'population',
                'capital',
                'language',
                'religion',
                'gdp',
                'happiness',
                'map',
                'covid',
                'detail',
                'created_at',
                'updated_at'
            ]),
            1
        );
    }

    public function testDatabaseReviews()
    {
        $this->assertTrue(
            Schema::hasColumns('reviews', [
                'id',
                'user_id',
                'country_id',
                'recommend',
                'safe',
                'fun',
                'tourism',
                'food',
                'english',
                'city',
                'review',
                'imgpath',
                'created_at',
                'updated_at'
            ]),
            1
        );
    }

    public function testDatabaseLikes()
    {
        $this->assertTrue(
            Schema::hasColumns('likes', [
                'id',
                'user_id',
                'country_id',
                'created_at',
                'updated_at'
            ]),
            1
        );
    }

    public function testDatabaseAcounts()
    {
        $this->assertTrue(
            Schema::hasColumns('acounts', [
                'id',
                'user_id',
                'gender',
                'age',
                'profile',
                'hobby',
                'icon',
                'created_at',
                'updated_at'
            ]),
            1
        );
    }

    public function testDatabaseImages()
    {
        $this->assertTrue(
            Schema::hasColumns('images', [
                'id',
                'user_id',
                'country_id',
                'imgpath',
                'created_at',
                'updated_at'
            ]),
            1
        );
    }
}
