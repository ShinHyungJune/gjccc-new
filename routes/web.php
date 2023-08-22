<?php

use App\Enums\Sex;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/test", function(){

  //  $product = \App\Models\Product::factory()->create();

    // $product->addMedia(storage_path("app\public\main_sec-1_1.jpg"))->preservingOriginal()->toMediaCollection("img", "s3");
});


Route::get("/home", function(){
    return redirect("/");
});

Route::post("/users", [\App\Http\Controllers\UserController::class, "store"]);

Route::get('/', [\App\Http\Controllers\PageController::class, "index"]);
Route::get('/story', [\App\Http\Controllers\PageController::class, "story"]);
Route::get('/privacy01', [\App\Http\Controllers\PageController::class, "privacy01"]);
Route::get('/privacy02', [\App\Http\Controllers\PageController::class, "privacy02"]);
Route::get('/privacy03', [\App\Http\Controllers\PageController::class, "privacy03"]);
Route::get('/privacy04', [\App\Http\Controllers\PageController::class, "privacy04"]);
Route::get('/datingProducts', [\App\Http\Controllers\DatingProductController::class, "index"]);
Route::get('/partyProducts', [\App\Http\Controllers\PartyProductController::class, "index"]);
Route::get('/partyProducts/{product}', [\App\Http\Controllers\PartyProductController::class, "show"]);
Route::get('/partyOrderProducts', [\App\Http\Controllers\PartyOrderProductController::class, "index"]);
Route::get('/datingReviews', [\App\Http\Controllers\DatingReviewController::class, "index"]);
Route::get('/datingReviews/{review}', [\App\Http\Controllers\DatingReviewController::class, "show"]);
Route::get('/partyReviews', [\App\Http\Controllers\PartyReviewController::class, "index"]);
Route::get('/partyReviews/{review}', [\App\Http\Controllers\PartyReviewController::class, "show"]);
Route::get('/datingNotices', [\App\Http\Controllers\DatingNoticeController::class, "index"]);
Route::get('/datingNotices/{notice}', [\App\Http\Controllers\DatingNoticeController::class, "show"]);
Route::get('/partyNotices', [\App\Http\Controllers\PartyNoticeController::class, "index"]);
Route::get('/partyNotices/{notice}', [\App\Http\Controllers\PartyNoticeController::class, "show"]);
Route::get('/commentNotices', [\App\Http\Controllers\CommentNoticeController::class, "index"]);
Route::get('/commentNotices/{notice}', [\App\Http\Controllers\CommentNoticeController::class, "show"]);

Route::get('/datingNotices/{notice}', [\App\Http\Controllers\DatingNoticeController::class, "show"]);

Route::post("/verifyNumbers", [\App\Http\Controllers\Api\VerifyNumberController::class, "store"]);
Route::patch("/verifyNumbers", [\App\Http\Controllers\Api\VerifyNumberController::class, "update"]);
Route::get("/verifications/complete", [\App\Http\Controllers\VerificationController::class, "complete"]);
Route::middleware("auth")->group(function(){
    // Route::get("/users/remove", [\App\Http\Controllers\UserController::class, "remove"]);
    Route::delete("/users", [\App\Http\Controllers\UserController::class, "destroy"]);
    // Route::get("/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);
    Route::post("/users/update", [\App\Http\Controllers\UserController::class, "update"]);
});

/*Route::middleware("guest")->group(function(){
    Route::get("/login", [\App\Http\Controllers\UserController::class, "loginForm"])->name("login");
    Route::get("/register", [\App\Http\Controllers\UserController::class, "create"]);
    Route::get("/openLoginPop/{social}", [\App\Http\Controllers\UserController::class, "openSocialLoginPop"]);
    Route::get("/login/{social}", [\App\Http\Controllers\UserController::class, "socialLogin"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    Route::resource("/users", \App\Http\Controllers\UserController::class);
    Route::get("/passwordResets/{token}/edit", [\App\Http\Controllers\PasswordResetController::class, "edit"]);
    Route::resource("/passwordResets", \App\Http\Controllers\PasswordResetController::class);
});*/


Route::middleware("auth")->group(function(){
    Route::get("/logout", [\App\Http\Controllers\UserController::class, "logout"]);

});

Route::get("/mailable", function(){
    return (new \App\Mail\PasswordResetCreated(new \App\Models\User(), new \App\Models\PasswordReset()));
});


// 개발

// 가끔 결제되는 순간 네트워크가 끊길 경우나 가상계좌처럼 입금이 나중에 되는 경우를 대비한 웹훅
Route::post("/iamport-webhook", [\App\Http\Controllers\OrderController::class, "complete"]);


Route::middleware("auth")->group(function(){
    Route::post("/orders", [\App\Http\Controllers\OrderController::class, "store"]);

    // 공통
    Route::get("/myShoppingPageController/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);

    // Route::resource("/carts", \App\Http\Controllers\CartController::class);

    Route::get("/myShoppingPageController/orders", [\App\Http\Controllers\OrderController::class, "index"]);
    Route::get("/orders/cancel", [\App\Http\Controllers\OrderController::class, "cancel"]);
    Route::get("/datings", [\App\Http\Controllers\DatingController::class, "index"]);
    Route::patch("/datings/{dating}", [\App\Http\Controllers\DatingController::class, "update"]);
    Route::patch("/datings/{dating}/read", [\App\Http\Controllers\DatingController::class, "read"]);
    // Route::resource("/orders", \App\Http\Controllers\OrderController::class);
});


Route::post("/orders/complete", [\App\Http\Controllers\OrderController::class, "complete"]);
Route::get("/orders/complete/mobile", [\App\Http\Controllers\OrderController::class, "complete"]);

Route::get("/orders/result", [\App\Http\Controllers\OrderController::class, "result"]);
Route::get("/orders/fail", [\App\Http\Controllers\OrderController::class, "fail"]);

Route::middleware("guest")->group(function(){
    Route::get("/login", [\App\Http\Controllers\UserController::class, "loginForm"])->name("login");
    Route::get("/register", [\App\Http\Controllers\UserController::class, "create"]);
    Route::get("/openLoginPop/{social}", [\App\Http\Controllers\UserController::class, "openSocialLoginPop"]);
    Route::get("/login/{social}", [\App\Http\Controllers\UserController::class, "socialLogin"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    // Route::resource("/users", \App\Http\Controllers\UserController::class);

    Route::get("/findIds/create", [\App\Http\Controllers\FindIdController::class, "create"]);
    Route::get("/findIds/search", [\App\Http\Controllers\FindIdController::class, "search"]);
    Route::get("/users/deleted", [\App\Http\Controllers\UserController::class, "deleted"]);

});

Route::patch("/passwordResets", [\App\Http\Controllers\PasswordResetController::class, "update"]);
Route::get("/passwordResets/{token}/edit", [\App\Http\Controllers\PasswordResetController::class, "edit"]);
Route::resource("/passwordResets", \App\Http\Controllers\PasswordResetController::class);

Route::resource("/notices", \App\Http\Controllers\Shopping\NoticeController::class);

Route::middleware("auth")->group(function(){
    Route::get("/users/remove", [\App\Http\Controllers\UserController::class, "remove"]);
    Route::get("/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);
    Route::resource("/reviews", \App\Http\Controllers\ReviewController::class);
    Route::get("/orders", [\App\Http\Controllers\OrderController::class, "index"]);
    Route::resource("/latestProducts", \App\Http\Controllers\Shopping\LatestProductController::class);
    Route::resource("/likes", \App\Http\Controllers\Shopping\LikeController::class);
    Route::resource("/qnas", \App\Http\Controllers\Shopping\QnaController::class);
    Route::get("/reviews", [\App\Http\Controllers\Shopping\ReviewController::class, "index"]);
    Route::get("/reviews/create", [\App\Http\Controllers\Shopping\ReviewController::class, "create"]);
    Route::post("/reviews", [\App\Http\Controllers\Shopping\ReviewController::class, "store"]);
    Route::get("/refunds", [\App\Http\Controllers\RefundController::class, "index"]);
    Route::patch("/refunds/{refund}/check", [\App\Http\Controllers\RefundController::class, "check"]);
    Route::post("/refunds", [\App\Http\Controllers\RefundController::class, "store"]);
    Route::post("/feedbacks", [\App\Http\Controllers\FeedbackController::class, "store"]);

    Route::post("/messages", [\App\Http\Controllers\MessageController::class, "store"]);
    Route::get("/chats/{dating}", [\App\Http\Controllers\ChatController::class, "show"]);

});
