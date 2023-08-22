<?php

namespace App\Console\Commands;

use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Enums\SmsTemplate;
use App\Models\Dating;
use App\Models\OrderProduct;
use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckChatOpenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:chat-open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '채팅창 오픈여부 확인';

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
        $datings = Dating::where("alarm_chat_open", false)
            ->where("check_address", true)
            ->whereNotNull("scheduled_at")
            ->where("scheduled_at", "<=", Carbon::now()->addDay()->endOfDay())
            ->cursor();

        $sms = new SMS();

        foreach($datings as $dating){
            $sms->send($dating->men->contact, [
                "url" => $dating->getChatUrl()
            ], SmsTemplate::CHAT_OPEN);

            $sms->send($dating->women->contact, [
                "url" => $dating->getChatUrl()
            ], SmsTemplate::CHAT_OPEN);

            $dating->update(["alarm_chat_open" => 1]);
        }
    }
}
