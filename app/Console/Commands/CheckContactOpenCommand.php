<?php

namespace App\Console\Commands;

use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Enums\SmsTemplate;
use App\Models\Chat;
use App\Models\Dating;
use App\Models\OrderProduct;
use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckContactOpenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:contact-open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '연락처 오픈여부 확인';

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
        $datings = Dating::where("alarm_contact_open", false)
            ->whereNotNull("scheduled_at")
            ->where("scheduled_at", "<=", Carbon::now()->addHour())
            ->cursor();

        foreach($datings as $dating){
            $chat = Chat::where("dating_id", $dating->id)->first();

            if(!$chat){
                $chat = Chat::create([
                    "dating_id" => $dating->id
                ]);

                $chat->users()->attach($dating->women->id, [
                    "has_new_message" => true,
                ]);

                $chat->users()->attach($dating->men->id,  [
                    "has_new_message" => true,
                ]);
            }

            $chat->messages()->create([
                "user_id" => $dating->men->id,
                "body" => "약속시간 1시간 전입니다. 부득이하게 연락이 필요할 경우에만 전화나 문자로 소통해주세요! ".$dating->men->contact,
            ]);

            $chat->messages()->create([
                "user_id" => $dating->women->id,
                "body" => "약속시간 1시간 전입니다. 부득이하게 연락이 필요할 경우에만 전화나 문자로 소통해주세요! ".$dating->women->contact,
            ]);

            $dating->update(["alarm_contact_open" => 1]);
        }
    }
}
