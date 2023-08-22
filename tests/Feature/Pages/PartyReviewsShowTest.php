<?php

namespace Tests\Feature\Pages;

use App\Enums\Sex;
use App\Models\Dating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartyReviewsShowTest extends TestCase
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
    public function 누구나_파티_리뷰상세를_조회할_수_있다()
    {
        /*$this->user->update([
            "sex" => Sex::MEN
        ]);

        $datings = Dating::factory()->count(3)->create([
            "men_id" => $this->user->id
        ]);

        $this->get("/datings")->assertInertia(function($page) use($datings){
            $items = $page->toArray()["props"]["datings"]["data"];

            $this->assertCount(count($datings), $items);
        });*/
    }
}
