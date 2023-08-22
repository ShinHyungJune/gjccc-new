<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VerificationResource;
use App\Models\Expert;
use App\Models\Iamport;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationController extends ApiController
{
    public function store(Request $request)
    {
        $request->validate([
            "imp_uid" => "required|string|max:50000",
            "merchant_uid" => "required|string|max:50000",
        ]);

        // 권한 얻기
        $accessToken = Iamport::getAccessToken();

        DB::beginTransaction();

        try {
            // 인증정보조회
            $impCertification = Iamport::getCertification($accessToken, $request->imp_uid);

            Verification::updateOrCreate([
                "phone" => $impCertification["phone"],
            ],[
                "phone" => $impCertification["phone"],
                "name" => $impCertification["name"],
                "birth" => $impCertification["birthday"],
                "sex" => $impCertification["gender"] == "male" ? "남자" : "여자",
                "imp_uid" => $request["imp_uid"],
                "merchant_uid" => $request["merchant_uid"]
            ]);

            DB::commit();
        }catch(\Exception $e) {

            DB::rollBack();
        }

        $verification = Verification::where("imp_uid", $request["imp_uid"])->first();

        if(!$verification)
            return $this->respondNotFound();

        return $this->respondSuccessfully(VerificationResource::make($verification));
    }
}
