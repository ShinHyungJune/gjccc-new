<?php

namespace Tests\Feature\Pages;

use App\Enums\ProductType;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartyProductsIndexTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    /** @test */
    public function 누구나_파티목록을_조회할_수_있다()
    {
        $datingProducts = Product::factory()->count(5)->create([
            "type" => ProductType::DATING
        ]);

        $partyProducts = Product::factory()->count(3)->create([
            "type" => ProductType::PARTY
        ]);

        $this->get("/partyProducts")->assertInertia(function($page) use($partyProducts){
            $items = $page->toArray()["props"]["products"]["data"];

            $this->assertCount(count($partyProducts), $items);
        });
    }

    /** @test */
    public function 누구나_예약중인_파티_상품목록만_조회할_수_있다()
    {
        $finishedDatingProducts = Product::factory()->count(5)->create([
            "type" => ProductType::PARTY,
            "opened_at" => Carbon::now()->subDays(3)
        ]);

        $openedDatingProducts = Product::factory()->count(3)->create([
            "type" => ProductType::PARTY,
            "opened_at" => Carbon::now()->addDays(3)
        ]);

        $this->json("get", "/partyProducts", [
            "state" => "예약중"
        ])->assertInertia(function($page) use($openedDatingProducts){
            $items = $page->toArray()["props"]["products"]["data"];

            $this->assertCount(count($openedDatingProducts), $items);
        });
    }

    /** @test */
    public function 누구나_마감된_파티_상품목록만_조회할_수_있다()
    {
        $finishedDatingProducts = Product::factory()->count(5)->create([
            "type" => ProductType::PARTY,
            "opened_at" => Carbon::now()->subDays(3)
        ]);

        $openedDatingProducts = Product::factory()->count(3)->create([
            "type" => ProductType::PARTY,
            "opened_at" => Carbon::now()->addDays(3)
        ]);

        $this->json("get", "/partyProducts", [
            "state" => "마감"
        ])->assertInertia(function($page) use($finishedDatingProducts){
            $items = $page->toArray()["props"]["products"]["data"];

            $this->assertCount(count($finishedDatingProducts), $items);
        });
    }
}
