<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductState;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\EventBannerResource;
use App\Http\Resources\VerificationResource;
use App\Models\Category;
use App\Models\EventBanner;
use App\Models\Expert;
use App\Models\User;
use App\Models\Verification;
use App\Models\VerifyNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function username()
    {
        return "ids";
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "required|string|max:500",
            "password" => "required|string|max:500",
        ]);

        if(auth()->attempt($request->all())) {
            session()->regenerate();

            return redirect()->intended();
        }

        return Inertia::render("Users/Login", [
            "errors" => [
                "email" => __("socialLogin.invalid")
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "contact" => "required|string|unique:users|max:500",
            "name" => "required|string|max:500",
            "sex" => "required|string|max:500",
            "birth" => "required|string|max:500",
            "job" => "required|string|max:500",
            "school" => "required|string|max:500",
            "city" => "required|string|max:500",
            "area" => "required|string|max:500",
            "need_service" => "required|string|max:500",
            "registration_way" => "required|string|max:500",

            "nickname" => "nullable|string|max:50000",
            "city_company" => "nullable|string|max:50000",
            "area_company" => "nullable|string|max:50000",
            "tall" => "nullable|string|max:50000",
            "weight" => "nullable|string|max:50000",
            "instagram" => "nullable|string|max:50000",
            "ideal" => "nullable|string|max:50000",
            "introduce" => "nullable|string|max:50000",
            "to_manager" => "nullable|string|max:50000",
            "marriage" => "nullable|string|max:50000",
            "agree_marketing" => "nullable|boolean",
            "imp_uid" => "nullable|string|max:50000",
        ]);

        if(!$request->social_id)
            $request->validate([
                "email" => "required|unique:users|email|max:500",
                "password" => "required|string|min:8|max:30|confirmed",
            ]);

        $verification = Verification::where('imp_uid', $request->imp_uid)->first();

        if(!$verification)
            return redirect()->back()->with("error", "본인인증한 사용자만 회원가입할 수 있습니다.");

        $user = User::create(array_merge($request->except(["password", "imgs"]), [
            "password" => $request->password ? Hash::make($request->password) : ""
        ]));

        if($request->imgs){
            foreach($request->imgs as $img){
                $user->addMedia($img)->toMediaCollection("imgs", "s3");
            }

            $media = $user->getMedia('imgs')[0];

            $user->addMediaFromUrl($media->getFullUrl())->toMediaCollection("img", "s3");
        }

        $verification->delete();

        return redirect("/login")->with("success", "성공적으로 가입되었습니다.");
    }

    public function openSocialLoginPop($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function socialLogin(Request $request, $social)
    {
        $socialUser = Socialite::driver($social)->user();

        $user = User::where("social_id", $socialUser->id)->where("social_platform", $social)->first();

        if(!$user)
            return redirect("/register?social_id=".$socialUser->id."&social_platform=".$social);

        Auth::login($user);

        return redirect()->intended();
    }

    public function update(Request $request)
    {
        $request->validate([
            "job" => "required|string|max:500",
            "school" => "required|string|max:500",
            "city" => "required|string|max:500",
            "area" => "required|string|max:500",
            "need_service" => "required|string|max:500",
            "registration_way" => "required|string|max:500",

            "nickname" => "nullable|string|max:50000",
            "city_company" => "nullable|string|max:50000",
            "area_company" => "nullable|string|max:50000",
            "tall" => "nullable|string|max:50000",
            "weight" => "nullable|string|max:50000",
            "instagram" => "nullable|string|max:50000",
            "ideal" => "nullable|string|max:50000",
            "introduce" => "nullable|string|max:50000",
            "to_manager" => "nullable|string|max:50000",
            "marriage" => "nullable|string|max:50000",
            "agree_marketing" => "nullable|boolean",
        ]);

        auth()->user()->update($request->except([
            "password", "name", "sex", "contact", "birth", "email"
        ]));

        // 올려놨던 이미지 정리(나중에는 올려놨던 이미지는 그대로 살리고, 새로 업로드되거나 삭제된 이미지만 걸러내는게 효율적이겠지? 일단은 다 지우고 다 업로드하는식)
        auth()->user()->clearMediaCollection("imgs");

        if($request->imgs){
            foreach($request->imgs as $img){
                auth()->user()->addMedia($img)->toMediaCollection("imgs", "s3");
            }
        }

        /*if($request->img){
            auth()->user()->addMedia($request->img)->toMediaCollection("img", "s3");
        }*/

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    public function loginForm()
    {
        return Inertia::render("Users/Login",[]);
    }

    public function create(Request $request)
    {
        $appUrl = config("app.url");
        $impId = config("iamport.imp_code");

        $verification = null;

        if($request->imp_uid)
            $verification = Verification::where("imp_uid", $request->imp_uid)->first();

        return Inertia::render("Users/Create", [
            "appUrl" => $appUrl,
            "impId" => $impId,
            "verification" => $verification ? VerificationResource::make($verification) : ""
        ]);
    }

    public function edit()
    {
        return Inertia::render("Users/Edit", [

        ]);
    }

    public function remove()
    {
        return Inertia::render("Users/Remove", []);
    }

    public function deleted()
    {
        return Inertia::render("Users/Deleted", []);
    }

    public function destroy(Request $request)
    {
        $request->validate([

        ]);

        /*$hasOngoingOrder = auth()->user()->orderProducts()->where("state", OrderProductState::WAIT)
            ->orWhere("state", OrderProductState::ONGOING)
            ->orWhere("state", OrderProductState::READY)
            ->count() > 0;

        $hasOngoingRefund = auth()->user()->refunds()->where("refunded", null)->count() > 0;

        if($hasOngoingOrder || $hasOngoingRefund)
            return redirect()->back()->with("error", "진행중인 주문이나 반품요청이 있을 경우 회원탈퇴를 진행할 수 없습니다.");

        if(!Hash::check($request->password, auth()->user()->password))
            return redirect()->back()->with("error", "비밀번호가 틀렸습니다.");*/

        auth()->user()->delete();

        /*
        $request->validate([
            "password" => "required|string|confirmed|max:500"
        ]);

        if(!Hash::check($request->password, auth()->user()->password))
            return redirect()->back()->with("error", "비밀번호가 틀렸습니다.");

        auth()->user()->update(["reason_leave_out" => $request->reason]);

        auth()->user()->forceDelete();
        */

        return redirect("/")->with("success", "성공적으로 처리되었습니다.");
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/");
    }
}
