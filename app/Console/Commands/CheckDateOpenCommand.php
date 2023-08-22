<?php

namespace App\Console\Commands;

use App\Enums\SmsTemplate;
use App\Models\Dating;
use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDateOpenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:date-open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '데이트 오픈여부 확인';

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
        $datings = Dating::where("alarm_date_open", false)
            ->where("check_address", true)
            ->whereNotNull("scheduled_at")
            ->where("scheduled_at", "<=", Carbon::now()->endOfDay())
            ->cursor();

        $sms = new SMS();

        foreach($datings as $dating){
            $sms->send($dating->men->contact, [
                "url" => $dating->getUrl(),
                "scheduled_at" => Carbon::make($dating->scheduled_at)->format("m월 d일 H:i"),
                "place_name" => $dating->place_name,
                "address_name" => $dating->address_name,
                "name" => $dating->men->nickname,
            ], SmsTemplate::DATE_OPEN);

            $sms->send($dating->women->contact, [
                "url" => $dating->getUrl(),
                "scheduled_at" => Carbon::make($dating->scheduled_at)->format("m월 d일 H:i"),
                "place_name" => $dating->place_name,
                "address_name" => $dating->address_name,
                "name" => $dating->men->nickname,
            ], SmsTemplate::DATE_OPEN);

            $dating->update(["alarm_date_open" => 1]);
        }
    }
}
