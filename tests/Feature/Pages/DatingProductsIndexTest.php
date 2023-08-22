<?php

namespace Tests\Feature\Pages;

use App\Enums\ProductType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatingProductsIndexTest extends TestCase
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
    public function 누구나_소개팅_상품_목록을_조회할_수_있다()
    {
        $datingProducts = Product::factory()->count(5)->create([
            "type" => ProductType::DATING
        ]);

        $partyProducts = Product::factory()->count(3)->create([
            "type" => ProductType::PARTY
        ]);

        $this->get("/datingProducts")->assertInertia(function($page) use($datingProducts){
            $items = $page->toArray()["props"]["products"]["data"];

            $this->assertCount(count($datingProducts), $items);
        });
    }
}
