<?php

namespace Tests\Feature\Pages;

use App\Enums\ProductType;
use App\Enums\Sex;
use App\Models\Dating;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatingsIndexTest extends TestCase
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
    public function 사용자는_자신에게_온_소개팅_목록을_조회할_수_있다()
    {
        $this->user->update([
            "sex" => Sex::MEN
        ]);

        $datings = Dating::factory()->count(3)->create([
            "men_id" => $this->user->id
        ]);

        $this->get("/datings")->assertInertia(function($page) use($datings){
            $items = $page->toArray()["props"]["datings"]["data"];

            $this->assertCount(count($datings), $items);
        });
    }

    /** @test */
    public function 사용자는_자신에게_온_안읽은_가장_최신의_소개팅을_조회할_수_있다()
    {
        $this->user->update([
            "sex" => Sex::MEN
        ]);

        $readDatings = Dating::factory()->count(2)->create([
            "men_id" => $this->user->id,
            "read_women" => true
        ]);

        $this->get("/datings")->assertInertia(function($page){
            $item = $page->toArray()["props"]["latestUnreadDating"];

            $this->assertNotEmpty($item);
        });

        foreach($readDatings as $readDating){
            $readDating->update([
                "read_men"=>true
            ]);
        }

        $this->get("/datings")->assertInertia(function($page){
            $item = $page->toArray()["props"]["latestUnreadDating"];

            $this->assertEmpty($item);
        });
    }

    /** @test */
    public function 사용자는_소개팅을_읽음완료처리할_수_있다()
    {
        $this->user->update([
            "sex" => Sex::MEN
        ]);

        $this->women = User::factory()->create(["sex" => Sex::WOMEN]);


        $dating = Dating::factory()->create([
            "men_id" => $this->user->id,
            "women_id" => $this->women->id,
        ]);

        // 매칭되지 않은 다른 사람일 경우 읽음처리 못함
        $this->other = User::factory()->create();

        $this->actingAs($this->other);

        $this->patch("/datings/".$dating->id."/read");

        $dating = Dating::find($dating->id);

        $this->assertEquals($dating->read_men, 0);


        // 여자일 경우 남지읽음처리 안됨

        $this->actingAs($this->women);

        $this->patch("/datings/".$dating->id."/read");

        $dating = Dating::find($dating->id);

        $this->assertEquals($dating->read_men, 0);


        // 남자일 경우 남자읽음처리됨
        $this->actingAs($this->user);

        $this->patch("/datings/".$dating->id."/read");

        $dating = Dating::find($dating->id);

        $this->assertEquals($dating->read_men, 1);
    }

    // (일정이 정해졌고, 해당 일정이 지났다면 완료처리)
    /** @test */
    public function 진행중인_소개팅목록을_조회할_수_있다()
    {
        $this->user->update([
            "sex" => Sex::MEN
        ]);

        $ongoingDatings = Dating::factory()->count(3)->create([
            "men_id" => $this->user->id,
            "scheduled_at" => Carbon::now()->addDays(3)
        ]);

        $finishedDatings = Dating::factory()->count(2)->create([
            "men_id" => $this->user->id,
            "scheduled_at" => Carbon::now()->subDays(3)
        ]);

        $this->json("get","/datings", [
            "state" => "진행중"
        ])->assertInertia(function($page) use($ongoingDatings){
            $items = $page->toArray()["props"]["datings"]["data"];

            $this->assertCount(count($ongoingDatings), $items);
        });
    }

    /** @test */
    public function 완료된_소개팅목록을_조회할_수_있다()
    {
        $this->user->update([
            "sex" => Sex::MEN
        ]);

        $ongoingDatings = Dating::factory()->count(3)->create([
            "men_id" => $this->user->id,
            "scheduled_at" => Carbon::now()->addDays(3)
        ]);

        $finishedDatings = Dating::factory()->count(2)->create([
            "men_id" => $this->user->id,
            "scheduled_at" => Carbon::now()->subDays(3)
        ]);

        $this->json("get","/datings", [
            "state" => "완료"
        ])->assertInertia(function($page) use($finishedDatings){
            $items = $page->toArray()["props"]["datings"]["data"];

            $this->assertCount(count($finishedDatings), $items);
        });
    }
}
