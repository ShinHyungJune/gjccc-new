<?php

namespace App\Jobs;

use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Models\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDeliveryStateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $needDeliveryCheckOrderProducts = OrderProduct::where("state", "!=", OrderProductState::DONE)->whereHas("order", function($query){
            return $query->where("state", "!=", OrderState::FAIL); // 결제실패 상품이 아닌것만
        })->get();

        foreach($needDeliveryCheckOrderProducts as $needDeliveryCheckOrderProduct){
            $needDeliveryCheckOrderProduct->checkDeliveryState();
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
