<?php

namespace App\Http\Controllers;

use App\Http\Resources\VerificationResource;
use App\Models\Iamport;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    public function complete(Request $request)
    {
        $request->validate([
            "imp_uid" => "required|string|max:50000",
        ]);

        $result = ["state" => "success", "message"=>"성공적으로 처리되었습니다"];

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
            ]);

            DB::commit();
        }catch(\Exception $e) {

            DB::rollBack();
        }

        $verification = Verification::where("imp_uid", $request["imp_uid"])->first();

        if(!$verification)
            return redirect()->back()->with("error", "인증 실패하였습니다.");

        $redirectUrl = "/register?imp_uid=".$request->imp_uid;

        if($request->social_id)
            $redirectUrl .= "&social_id=".$request->social_id."&social_platform=".$request->social_platform;

        return redirect($redirectUrl);
    }
}
