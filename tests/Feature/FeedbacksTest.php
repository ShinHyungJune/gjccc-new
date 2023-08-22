<?php

namespace Tests\Feature;

use App\Enums\Sex;
use App\Models\Dating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedbacksTest extends TestCase
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
    public function 사용자는_완료된_소개팅에_후기를_생성할_수_있다()
    {
      /*  $this->user->update([
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
