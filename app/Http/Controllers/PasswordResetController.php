<?php

namespace App\Http\Controllers;

use App\Enums\KakaoTemplate;
use App\Mail\PasswordResetCreated;
use App\Models\Kakao;
use App\Models\PasswordReset;
use App\Models\SMS;
use App\Models\User;
use App\Models\VerifyNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PasswordResetController extends \ShinHyungJune\SocialLogin\Http\PasswordResetController
{
    public function store(Request $request)
    {
        $request->validate([
            "ids" => "required|string|max:500",
            "contact" => "required|string|max:500"
        ]);

        $verifyNumber = VerifyNumber::where('contact', $request->contact)
            ->where('verified', true)->first();

        if(!$verifyNumber)
            return redirect()->back()->with("error", "인증된 전화번호로만 진행할 수 있습니다.");

        if(!User::where("contact", $request->contact)->where("email", $request->ids)->exists())
            return redirect()->back()->with("error", "유효하지 않은 정보입니다.");

        $token = random_int(100000000,999999999);

        $passwordReset = PasswordReset::where("id", $request->ids)->first();

        $passwordReset ? $passwordReset->update([
            "ids" => $request->ids,
            "token" => $token
        ]) : $passwordReset = PasswordReset::create([
            "ids" => $request->ids,
            "token" => $token
        ]);

        // 이 부분도 카카오톡 연동으로 들어가야겠지
        /*
        $kakao = new Kakao();

        try {
            $kakao->send(str_replace("-","",$request->contact), [
                "number" => $token
            ], KakaoTemplate::NUMBER_SEND);
        }catch(\Exception $exception){
            return redirect()->back()->with("error", "유효하지 않은 연락처입니다.");
        }

        $verifyNumber->delete();
        */

        return redirect("/passwordResets/".$passwordReset->token."/edit")->with("success", "");
    }

    public function create()
    {
        return Inertia::render("PasswordResets/Create");
    }

    public function edit(Request $request)
    {
        return Inertia::render("PasswordResets/Edit", [
            "token" => $request->token
        ]);
    }

    public function result($token)
    {
        $passwordReset = PasswordReset::where("token", $token)->first();

        if(!$passwordReset)
            return redirect("/");

        $resetPassword = $passwordReset->password;

        if($passwordReset)
            $passwordReset->delete();

        return Inertia::render("PasswordResets/Result", [
            "password" => $resetPassword
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "token" => "required|string|max:5000",
            "password" => "required|string|min:8|max:500|confirmed"
        ]);

        $passwordReset = PasswordReset::where("token", $request->token)
            ->first();

        $user = User::where("email", $passwordReset->ids)->first();

        if(!$user || !$passwordReset){
            return redirect()->back()->with("error", "유효하지 않은 토큰이거나 존재하지 않는 아이디입니다.");
        }

        $user->update(["password" => Hash::make($request->password)]);

        $passwordReset->where("ids", $request->ids)->delete();

        return redirect("/login")->with("success", "비밀번호가 변경되었습니다.");
    }
}
