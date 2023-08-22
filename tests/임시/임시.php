<?php

namespace Tests\Feature\Pages;

use App\Enums\BrandEventType;
use App\Enums\ShoppingEventType;
use App\Models\BrandEvent;
use App\Models\ShoppingBanner;
use App\Models\ShoppingEvent;
use App\Models\User;
use Database\Factories\ShoppingEventFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandEventsIndexTest extends TestCase
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
    public function 이벤트_목록을_조회할_수_있다()
    {
        $events = BrandEvent::factory()->count(5)->create();

        $this->get("/brand/brandEvents")->assertInertia(function($page) use($events){
            $items = $page->toArray()["props"]["events"]["data"];

            $this->assertCount(count($events), $items);
        });
    }

    /** @test */
    public function 타입별_이벤트목록을_조회할_수_있다()
    {
        $events = BrandEvent::factory()->count(5)->create([
            "type" => BrandEventType::EVENT
        ]);

        $luckies = BrandEvent::factory()->count(3)->create([
            "type" => BrandEventType::LUCKY
        ]);

        $this->json("get", "/brand/brandEvents", [
            "type" => BrandEventType::EVENT
        ])->assertInertia(function($page) use($events){
            $items = $page->toArray()["props"]["brandEvents"]["data"];

            $this->assertCount(count($events), $items);
        });

        $this->json("get", "/brand/brandEvents", [
            "type" => BrandEventType::LUCKY
        ])->assertInertia(function($page) use($luckies){
            $items = $page->toArray()["props"]["brandEvents"]["data"];

            $this->assertCount(count($luckies), $items);
        });
    }

    /** @test */
    public function 쇼핑몰이벤트에_검색결과처럼_탭메뉴_넣어야돼()
    {

    }
}
