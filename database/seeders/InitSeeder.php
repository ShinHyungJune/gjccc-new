<?php

namespace Database\Seeders;

use App\Enums\NoticeType;
use App\Enums\ProductType;
use App\Enums\Sex;
use App\Models\Information;
use App\Models\Notice;
use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\Review;
use App\Models\Usage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;
use PhpOption\Option;
use Symfony\Component\Console\Question\Question;

class InitSeeder extends Seeder
{
    protected $user;

    protected $imgs = [
        "https://swiperjs.com/demos/images/nature-1.jpg",
        "https://swiperjs.com/demos/images/nature-2.jpg",
        "https://swiperjs.com/demos/images/nature-3.jpg",
        "https://swiperjs.com/demos/images/nature-4.jpg",
        "https://swiperjs.com/demos/images/nature-5.jpg",
        "https://swiperjs.com/demos/images/nature-6.jpg",
        "https://swiperjs.com/demos/images/nature-7.jpg",
        "https://swiperjs.com/demos/images/nature-8.jpg",
        "https://swiperjs.com/demos/images/nature-9.jpg",
        "https://swiperjs.com/demos/images/nature-10.jpg",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Product::truncate();
        User::truncate();
        PayMethod::truncate();
        Review::truncate();
        Notice::truncate();
        DB::statement("SET foreign_key_checks=1");

        $this->createUsers();
        $this->createProducts();
        $this->createPayMethods();
        $this->createReviews();
        $this->createNotices();
    }

    public function createUsers()
    {
        $users = User::get();

        foreach($users as $user){
            $user->delete();
        }

        $user = User::factory()->create([
            "email" => "girl@naver.com",
            "contact" => "01030217486",
            "name" => "여자1호",
            "sex" => Sex::WOMEN,
            "birth" => "1995",
            "job" => "간호사",
            "school" => "대졸",
            "city" => "서울시",
            "area" => "강남구",
            "need_service" => "소개팅 프로그램",
            "registration_way" => "인스타그램",
            "city_company" => "서울시",
            "area_company" => "강남구",

            "tall" => "174",
            "weight" => "79",
            "instagram" => "",

            "ideal" => "이상형",
            "introduce" => "잘 부탁드려요",
            "to_manager" => "매칭 잘해주세요",
            "marriage" => "미혼",
            "comment_manager" => "이분은 정말 성실한 여성분이세요",
            "count_dating" => 3,
            "password" => Hash::make("girl@naver.com")
        ]);

        $user->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("imgs", "s3");

        $user = User::factory()->create([
            "email" => "girl2@naver.com",
            "contact" => "01030217486",
            "name" => "여자2호",
            "sex" => Sex::WOMEN,
            "birth" => "1995",
            "job" => "간호사",
            "school" => "대졸",
            "city" => "서울시",
            "area" => "강남구",
            "need_service" => "소개팅 프로그램",
            "registration_way" => "인스타그램",
            "city_company" => "서울시",
            "area_company" => "강남구",

            "tall" => "174",
            "weight" => "79",
            "instagram" => "",

            "ideal" => "이상형",
            "introduce" => "잘 부탁드려요",
            "to_manager" => "매칭 잘해주세요",
            "marriage" => "미혼",
            "comment_manager" => "이분은 정말 성실한 여성분이세요",
            "count_dating" => 2,
            "password" => Hash::make("girl2@naver.com")
        ]);

        $user->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("imgs", "s3");


        $user = User::factory()->create([
            "email" => "men@naver.com",
            "contact" => "01030217486",
            "name" => "남자1호",
            "sex" => Sex::MEN,
            "birth" => "1995",
            "job" => "변호사",
            "school" => "대졸",
            "city" => "강원도",
            "area" => "춘천시",
            "need_service" => "소개팅 프로그램",
            "registration_way" => "인스타그램",
            "city_company" => "강원도",
            "area_company" => "춘천시",

            "tall" => "174",
            "weight" => "79",
            "instagram" => "",

            "ideal" => "이상형",
            "introduce" => "잘 부탁드려요",
            "to_manager" => "매칭 잘해주세요",
            "marriage" => "미혼",
            "comment_manager" => "이분은 정말 성실한 남성분이세요",
            "count_dating" => 3,
            "password" => Hash::make("men@naver.com")
        ]);

        $user->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("imgs", "s3");

        $user = User::factory()->create([
            "email" => "men2@naver.com",
            "contact" => "01030217486",
            "name" => "남자2호",
            "sex" => Sex::MEN,
            "birth" => "1995",
            "job" => "변호사",
            "school" => "대졸",
            "city" => "강원도",
            "area" => "춘천시",
            "need_service" => "소개팅 프로그램",
            "registration_way" => "인스타그램",
            "city_company" => "강원도",
            "area_company" => "춘천시",

            "tall" => "174",
            "weight" => "79",
            "instagram" => "",

            "ideal" => "이상형",
            "introduce" => "잘 부탁드려요",
            "to_manager" => "매칭 잘해주세요",
            "marriage" => "미혼",
            "comment_manager" => "이분은 정말 성실한 남성분이세요",
            "count_dating" => 5,
            "password" => Hash::make("men2@naver.com")
        ]);

        $user->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("imgs", "s3");

    }

    public function createPayMethods()
    {
        $payMethods = PayMethod::get();

        foreach($payMethods as $payMethod){
            $payMethod->delete();
        }

        $payMethods = [
            [
                "pg" => "html5_inicis",
                "method" => "card",
                "name" => "신용카드",
                "commission" => "7",
            ],
            [
                "pg" => "html5_inicis",
                "method" => "phone",
                "name" => "휴대폰",
                "commission" => "10",
            ],
        ];

        foreach($payMethods as $payMethod){
            PayMethod::factory()->create([
                "pg" => $payMethod["pg"],
                "method" => $payMethod["method"],
                "name" => $payMethod["name"],
                "commission" => $payMethod["commission"],
            ]);
        }
    }

    public function createProducts()
    {
        $datingProducts = [
            [
                "title" => "1개월",
                "price" => 0,
                "options" => [
                    [
                        "title" => "10대",
                        "price" => "1000",
                    ],
                    [
                        "title" => "20대",
                        "price" => "1010",
                    ],
                    [
                        "title" => "30대",
                        "price" => "1030",
                    ],
                ]
            ],
            [
                "title" => "2개월",
                "price" => 0,
                "options" => [
                    [
                        "title" => "10대",
                        "price" => "1010",
                    ],
                    [
                        "title" => "20대",
                        "price" => "1020",
                    ],
                ]
            ]
        ];

        foreach($datingProducts as $datingProduct){
            $createdItem = Product::factory()->create([
                "title" => $datingProduct["title"],
                "price" => $datingProduct["price"]
            ]);

            foreach($datingProduct["options"] as $option){
                Product::factory()->create([
                    "product_id" => $createdItem->id,
                    "title" => $option["title"],
                    "price" => $option["price"]
                ]);
            }

        }

        $partyProducts = [
            [
                "type" => ProductType::PARTY,
                "title" => "10 : 10 와인파티",
                "price" => 0,
                "place" => "해운대구",
                "age" => "25~35세",
                "max_men" => 2,
                "max_women" => 1,
                "tags" => "#와인#파티#선상",
                "opened_at" => Carbon::now()->addDay(),
                "options" => [
                    [
                        "title" => "혼자 참여",
                        "price" => "1010",
                    ],
                    [
                        "title" => "친구와 함께",
                        "price" => "1020",
                    ],
                ]
            ],
            [
                "type" => ProductType::PARTY,
                "title" => "10 : 10 선상파티",
                "price" => 0,
                "place" => "해운대구",
                "age" => "25~35세",
                "max_men" => 2,
                "max_women" => 1,
                "tags" => "#와인#파티#선상",
                "opened_at" => Carbon::now()->addDay(),
                "options" => [
                    [
                        "title" => "혼자 참여",
                        "price" => "1010",
                    ],
                    [
                        "title" => "친구와 함께",
                        "price" => "1020",
                    ],
                ]
            ],
            [
                "type" => ProductType::PARTY,
                "title" => "10 : 10 마감파티",
                "price" => 0,
                "place" => "해운대구",
                "age" => "25~35세",
                "max_men" => 2,
                "max_women" => 1,
                "tags" => "#와인#파티#선상",
                "opened_at" => Carbon::now()->subDay(),
                "options" => [
                    [
                        "title" => "혼자 참여",
                        "price" => "1010",
                    ],
                    [
                        "title" => "친구와 함께",
                        "price" => "1020",
                    ],
                ]
            ],
        ];

        foreach($partyProducts as $partyProduct){

            $createdItem = Product::factory()->create(Arr::except($partyProduct, "options"));

            foreach($partyProduct["options"] as $option){
                Product::factory()->create([
                    "product_id" => $createdItem->id,
                    "title" => $option["title"],
                    "price" => $option["price"]
                ]);
            }

            $createdItem->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("img", "s3");
        }
    }

    public function createReviews()
    {
        $datingReviews = [
            [
                "sex" => "여",
                "age" => "20대",
                "job" => "연구원",
                "description" => "<p>매우 마음에 드는 이성을 만나서 결혼까지 골인했습니다. 정말 행복한 순간이었습니다 감사합니다.</p>",
                "type" => ProductType::DATING,
                "title" => "인사에서 평생을 함께할 인생의 반려를 만났습니다."
            ],
            [
                "sex" => "남",
                "age" => "30대",
                "job" => "직장인",
                "description" => "<p>매우 마음에 드는 여성을 만나서 결혼까지 골인했습니다. 정말 행복한 순간이었습니다 감사합니다.</p>",
                "type" => ProductType::DATING,
                "title" => "인사에서 평생을 함께할 인생의 반려를 만났습니다."
            ]
        ];

        $partyReviews = [
            [
                "description" => "<p>매우 마음에 드는 이성을 만나서 결혼까지 골인했습니다. 정말 행복한 순간이었습니다 감사합니다.</p>",
                "type" => ProductType::PARTY,
                "title" => "해운대구 10 : 10 와인파티 후기"
            ],
            [
                "description" => "<p>매우 마음에 드는 이성을 만나서 결혼까지 골인했습니다. 정말 행복한 순간이었습니다 감사합니다.</p>",
                "type" => ProductType::PARTY,
                "title" => "강남 10 : 10 힐링파티 후기"
            ],
        ];

        foreach($datingReviews as $datingReview){
            $createdItem = Review::factory()->create($datingReview);

            $createdItem->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("img", "s3");
        }

        foreach($partyReviews as $partyReview){
            $createdItem = Review::factory()->create($partyReview);

            $createdItem->addMediaFromUrl($this->imgs[rand(0, count($this->imgs) - 1)])->preservingOriginal()->toMediaCollection("img", "s3");
        }
    }

    public function createNotices()
    {
        Notice::factory()->count(3)->create([
            "type" => NoticeType::DATING,
            "title" => NoticeType::DATING
        ]);

        Notice::factory()->count(3)->create([
            "type" => NoticeType::PARTY,
            "title" => NoticeType::PARTY
        ]);

        Notice::factory()->count(3)->create([
            "type" => NoticeType::COMMENT,
            "title" => NoticeType::COMMENT
        ]);

    }
}
