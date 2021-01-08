<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Country;

class PageChangeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;

    //メインページ遷移テスト
    public function testMainPageShow()
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertViewIs('pages.main')
            ->assertViewHasAll([
                'countries',
                'information'
            ])
            ->assertSee('さあ 旅に出かけよう！');
    }

    //国詳細ページ遷移テスト
    public function testCountryDetailPageShow()
    {
        $country = factory(Country::class)->create();

        $response = $this->get(route('detail', ['id' => $country->id]));

        $response->assertOk()
            ->assertViewIs('pages.detail')
            ->assertViewHas('country')
            ->assertSee($country->name);
    }

    //検索後遷移テスト
    public function testSerchPageShow()
    {
        $response = $this->get(route('serch'));

        $response->assertOk()
            ->assertViewIs('pages.main')
            ->assertViewHasAll([
                'countries',
                'information',
                'message'
            ])
            ->assertSee('さあ 旅に出かけよう！');
    }

    //ランキングページ遷移テスト
    public function testRankingPageShow()
    {
        $response = $this->get(route('ranking'));

        $response->assertOk()
            ->assertViewIs('pages.ranking')
            ->assertSee('ランキング');
    }

    //ランキングページAPI遷移テスト
    public function testRankingAreaPageShow()
    {
        $response = $this->get('/api/area');

        $response->assertStatus(200);
    }

    //ランキングページAPI遷移テスト
    public function testRankingPopulationPageShow()
    {
        $response = $this->get('/api/population');

        $response->assertStatus(200);
    }

    //ランキングページAPI遷移テスト
    public function testRankingGdpPageShow()
    {
        $response = $this->get('/api/gdp');

        $response->assertStatus(200);
    }

    //ランキングページAPI遷移テスト
    public function testRankingHappinessPageShow()
    {
        $response = $this->get('/api/happiness');

        $response->assertStatus(200);
    }
}
