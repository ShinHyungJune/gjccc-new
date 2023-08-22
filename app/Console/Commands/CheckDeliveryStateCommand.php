<?php

namespace App\Console\Commands;

use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Jobs\CheckDeliveryStateJob;
use App\Models\OrderProduct;
use Illuminate\Console\Command;

class CheckDeliveryStateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:delivery-state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '배송조회';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $needDeliveryCheckOrderProducts = OrderProduct::where("state", "!=", OrderProductState::DONE)->whereHas("order", function($query){
            return $query->where("state", "!=", OrderState::FAIL); // 결제실패 상품이 아닌것만
        })->get();

        foreach($needDeliveryCheckOrderProducts as $needDeliveryCheckOrderProduct){
            $needDeliveryCheckOrderProduct->checkDeliveryState();
        }
    }
}
