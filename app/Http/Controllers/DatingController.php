<?php

namespace App\Http\Controllers;

use App\Enums\Sex;
use App\Enums\SmsTemplate;
use App\Http\Resources\DatingResource;
use App\Models\Dating;
use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DatingController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "state" => "nullable|string|max:500"
        ]);

        $request["state"] = $request->state ?? "진행중";

        $datings = auth()->user()->datings()->has(auth()->user()->getPartnerRelation())->latest();

        if($request->state == "진행중")
            $datings = $datings->where(function($query){
                return $query->where("scheduled_at", ">", Carbon::now()->subHour())->orWhere("scheduled_at", null);
            });

        if($request->state == "완료")
            $datings = $datings->where(function($query){
                return $query->where("scheduled_at", "<=", Carbon::now()->subHour())->where("scheduled_at", "!=", null);
            });

        $datings = $datings->paginate(60);

        $latestUnreadDating = auth()->user()->datings()->has(auth()->user()->getPartnerRelation())->latest()->where(auth()->user()->getReadColumn(), false)->first();

        if($latestUnreadDating)
            $latestUnreadDating->update([
                auth()->user()->getReadColumn() => 1
            ]);

        return Inertia::render("Datings/Index", [
            "state" => $request->state,
            "datings" => DatingResource::collection($datings),
            "latestUnreadDating" => $latestUnreadDating ? DatingResource::make($latestUnreadDating) : "",
        ]);
    }

    public function update(Dating $dating, Request $request)
    {
        $request->validate([
            "type" => "required|string|max:500"
        ]);

        $sms = new SMS();

        // 여자가 일정제안
        if($request->type == "일정제안"){
            $request->validate([
                "city1" => "required|string|max:500",
                "city2" => "required|string|max:500",
                "area1" => "required|string|max:500",
                "area2" => "required|string|max:500",

                "schedule1" => "required|string|max:500",
                "schedule2" => "required|string|max:500",
                "schedule3" => "required|string|max:500",
                "schedule4" => "required|string|max:500",
                "schedule5" => "required|string|max:500",
                "schedule6" => "required|string|max:500",
                "schedule7" => "nullable|string|max:500",
                "schedule8" => "nullable|string|max:500",
                "schedule9" => "nullable|string|max:500",
                "schedule10" => "nullable|string|max:500",
            ]);


            $dating->update([
                "city1" => $request->city1,
                "city2" => $request->city2,
                "area1" => $request->area1,
                "area2" => $request->area2,

                "schedule1" => $request->schedule1,
                "schedule2" => $request->schedule2,
                "schedule3" => $request->schedule3,
                "schedule4" => $request->schedule4,
                "schedule5" => $request->schedule5,
                "schedule6" => $request->schedule6,
                "schedule7" => $request->schedule7,
                "schedule8" => $request->schedule8,
                "schedule9" => $request->schedule9,
                "schedule10" => $request->schedule10,
            ]);

            // #메시지발송필요
            $sms->send($dating->men->contact, [
                "url" => $dating->getUrl(),
            ], SmsTemplate::NEW_SCHEDULE);
        }

        // 여자가 장소확인
        if($request->type == "장소확인"){
            $request->validate(["check_address" => "required|boolean"]);

            $dating->update(["check_address" => $request->check_address]);

            // #메시지발송필요
        }

        // 남자가 장소제안
        if($request->type == "장소제안"){
            $request->validate([
                "address_name" => "required|string|max:500",
                "place_name" => "required|string|max:500",
                "place_url" => "required|string|max:500",
                "scheduled_at" => "required|string|max:500"
            ]);

            $dating->update([
                "address_name" => $request->address_name,
                "place_name" => $request->place_name,
                "place_url" => $request->place_url,
                "scheduled_at" => $request->scheduled_at
            ]);

            // #메시지발송필요
            $sms->send($dating->women->contact, [
                "url" => $dating->getUrl(),
            ], SmsTemplate::NEW_ADDRESS);
        }

        return redirect()->back()->with("success");
    }

    public function read(Dating $dating)
    {
        $dating = auth()->user()->datings()->find($dating->id);

        if($dating)
            $dating->update([
                auth()->user()->getReadColumn() => 1
            ]);

        return redirect()->back()->with("success", "");
    }
}
