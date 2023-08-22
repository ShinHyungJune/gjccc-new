<?php

namespace Tests\Feature\Pages;

use App\Enums\ProductType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartyOrderProductsIndexTest extends TestCase
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
    public function 사용자는_자신의_주문이_성공한_파티상품주문건을_조회할_수_있다()
    {
        /*$datingProducts = Product::factory()->count(5)->create([
            "type" => ProductType::DATING
        ]);

        $partyProducts = Product::factory()->count(3)->create([
            "type" => ProductType::PARTY
        ]);

        $this->get("/datingProducts")->assertInertia(function($page) use($datingProducts){
            $items = $page->toArray()["props"]["products"]["data"];

            $this->assertCount(count($datingProducts), $items);
        });*/
    }

    /** @test */
    public function 파티상품주문건에는_파티상품정보가_담겨있다()
    {

    }

    /** @test */
    public function 오픈일자가_지나지_않은_파티상품주문건을_조회할_수_있다()
    {

    }

    /** @test */
    public function 오픈일자가_지난_파티상품주문건을_조회할_수_있다()
    {

    }
}
