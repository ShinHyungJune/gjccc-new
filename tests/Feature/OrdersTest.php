<?php

namespace Tests\Feature;

use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Enums\ProductType;
use App\Enums\Sex;
use App\Models\OptionProduct;
use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $payMethod;

    protected $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        $this->payMethod = PayMethod::factory()->create();

        $this->form = [
            "pay_method_id" => $this->payMethod->id,
        ];
    }

    /** @test */
    public function 사용자가_소개팅_상품을_구매완료하면_소개팅_가능횟수가_늘어난다()
    {
        $product = Product::factory()->create([
            "type" => ProductType::DATING,
        ]);

        $option = Product::factory()->create([
            "product_id" => $product->id,
        ]);

        $this->form["product_id"] = $product->id;
        $this->form["option_id"] = $option->id;

        $this->post("/orders", $this->form);

        $order = $this->user->orders()->first();

        $order->update(["state" => OrderState::SUCCESS]);

        $user = User::find($this->user->id);

        $this->assertEquals($user->count_dating, $product->count_dating);
        $this->assertEquals($order->price, $product->price + $option->price);
    }

    /** @test */
    function 오픈일자가_지난_파티_상품은_구매할_수_없다()
    {
        $product = Product::factory()->create([
            "type" => ProductType::PARTY,
            "opened_at" => Carbon::now()->subDay(),
        ]);

        $option = Product::factory()->create([
            "product_id" => $product->id,
        ]);

        $this->form["product_id"] = $product->id;
        $this->form["option_id"] = $option->id;

        $this->post("/orders", $this->form);

        $this->assertCount(0, Order::get());
    }

    /** @test */
    function 오픈일자가_지나지_않은_상품은_구매할_수_있다()
    {
        $product = Product::factory()->create([
            "type" => ProductType::PARTY,
            "opened_at" => Carbon::now()->addDay(),
        ]);

        $option = Product::factory()->create([
            "product_id" => $product->id,
        ]);

        $this->form["product_id"] = $product->id;
        $this->form["option_id"] = $option->id;

        $this->post("/orders", $this->form);

        $this->assertCount(1, Order::get());
    }

    /** @test */
    function 성별에_따라_최대참여인원이_꽉찬_파티를_구매할_수_없다()
    {
        $this->user->update(["sex" => Sex::WOMEN]);

        $product = Product::factory()->create([
            "type" => ProductType::PARTY,
            "max_women" => 0,
            "max_men" => 1,
        ]);

        $option = Product::factory()->create([
            "product_id" => $product->id,
        ]);

        $this->form["product_id"] = $product->id;
        $this->form["option_id"] = $option->id;

        $this->post("/orders", $this->form);

        $this->assertCount(0, Order::get());

        $this->user->update(["sex" => Sex::MEN]);

        $this->post("/orders", $this->form);

        $this->assertCount(1, Order::get());
    }
}
