<template>
    <main class="subpage party-service">
        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Service</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">서비스</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">파티신청</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- story -->
        <div class="main-container">
            <div class="party-contents">
                <div class="container sub">
                    <img :src="product.img ? product.img.url : ''" alt="">
                    <div class="party-reservation">
                        <div class="party-main">
                            <span class="party-date">{{ product.opened_at }}</span>
                            <p class="party-title">{{ product.title }}</p>
                            <div class="party-tag">
                                <span v-for="(tag, index) in product.tags" :key="index">{{ tag }}</span>
                            </div>
                        </div>
                        <div class="party-info">
                            <!-- 리스트 넣어야함 -->
                            <ul class="refund-box refund-box-1 row-group">
                                <li class="col-group">
                                    <p class="default">장소·연령</p>
                                    <ul class="user col-group">
                                        <li class="col-group">
                                            <span class="label">장소</span>
                                            <p class="addr">{{ product.place }}</p>
                                        </li>
                                        <li class="col-group">
                                            <span class="label">연령</span>
                                            <p class="age">{{ product.age }}</p>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-group">
                                    <p class="default">참가비</p>
                                    <ul class="user col-group">
                                        <li class="col-group" v-for="option in product.options" :key="product.id">
                                            <span class="label">{{ option.title }}</span>
                                            <p class="price">{{ option.price.toLocaleString() }}원</p>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-group">
                                    <p class="default">실시간</p>
                                    <ul class="user col-group">
                                        <li class="col-group">
                                            <span class="label">여자</span>
                                            <p class="price">{{ product.accept_women }}/{{ product.max_women }}</p>
                                        </li>
                                        <li class="col-group">
                                            <span class="label">남자</span>
                                            <p class="price">{{ product.accept_men }}/{{ product.max_men }}</p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <button class="party-request" @click="active = true">파티예약</button>
                    </div>
                </div>
            </div>

            <!-- 파티 신청 -->
            <div class="modal-overley open" v-if="active">
                <div class="modal-wrap request">
                    <button type="button" class="close" @click="active = false;">
                        <i class="xi-close"></i>
                    </button>
                    <div class="title-wrap only">
                        <img src="/images/crown2.png" alt="">
                        <h2 class="title">
                            파티예약
                        </h2>
                        <p class="txt"></p>
                    </div>
                    <form action="" @submit.prevent="order">
                        <div class="request-wrap form-wrap">
                            <div class="request-info-main">
                                <p class="title">
                                    {{ product.title }}
                                </p>
                                <div class="date">
                                    <p>
                                        {{ product.opened_at }}
                                    </p>
                                </div>
                            </div>
                            <ul class="request-box request-box-1 row-group">
                                <li class="col-group">
                                    <p class="default">장소·연령</p>
                                    <ul class="user col-group">
                                        <li class="col-group">
                                            <span class="label">장소</span>
                                            <p class="addr">{{ product.place }}</p>
                                        </li>
                                        <li class="col-group">
                                            <span class="label">연령</span>
                                            <p class="age">{{ product.age }}</p>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-group">
                                    <p class="default">참가비</p>
                                    <ul class="user col-group">
                                        <li class="col-group" v-for="option in product.options" :key="option.id">
                                            <span class="label">{{option.id}}}</span>
                                            <p class="price">{{ option.price.toLocaleString() }}원</p>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-group">
                                    <p class="default">실시간</p>
                                    <ul class="user col-group">
                                        <li class="col-group">
                                            <span class="label">여자</span>
                                            <p class="col-group state-num">
                                                <span>{{ product.accept_women }}/{{ product.max_women }}</span>
                                            </p>
                                        </li>
                                        <li class="col-group">
                                            <span class="label">남자</span>
                                            <p class="col-group state-num">
                                                <span>{{ product.accept_men }}/{{ product.max_men }}</span>
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="request-box request-box-2 form-box row-group">
                                <li class="col-group">
                                    <p class="default">이름</p>
                                    <div class="user">
                                        <p class="nonedit">{{ user.name }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">생년월일</p>
                                    <div class="user">
                                        <p class="nonedit">{{ user.birth }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">연락처</p>
                                    <div class="user col-group">
                                        <p class="nonedit">{{ user.contact }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">참가비</p>
                                    <div class="user col-group">
                                        <label :for="option.id" v-for="option in product.options" :key="option.id">
                                            <input type="radio" :id="option.id" :value="option.id" name="invite_check" v-model="form.option_id">
                                            <span class="radio-icon"></span>
                                            {{ option.title }}
                                        </label>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">결제수단</p>
                                    <div class="user">
                                        <select v-model="form.pay_method_id">
                                            <option value="" disabled>선택</option>
                                            <option v-for="payMethod in payMethods.data" :value="payMethod.id" :key="payMethod.id">{{ payMethod.name }}</option>
                                        </select>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">결제금액</p>
                                    <div class="user col-group">
                                        <p class="nonedit">{{ totalPrice.toLocaleString() }}</p>원
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="notice-box">
                            <div class="title-box">
                                <p class="title">
                                    <i class="xi-warning"></i>
                                    환불 규정
                                </p>
                                <p class="txt">
                                    참가비 환불 절차는 공정거래위원회의 소비자 환불규정에 따라 아래와 같습니다.
                                    참석 인원 미달되거나 주최측에 의한 이벤트 취소의 경우, 전액 환불 도와드립니다.
                                </p>
                            </div>
                            <div class="con-box">
                                <p class="title">
                                    개인적인 사유로 취소 신청할 경우
                                </p>
                                <ul class="row-group">
                                    <li>소개팅일자 7일 이전: 입장료 전액 환불 (송금수수료 -1,000원 공제)</li>
                                    <li>소개팅일자 5일 이전: 입장료 70% 환불</li>
                                    <li>소개팅일자 4일 이전: 입장료 50% 환불</li>
                                    <li>소개팅일자 3일 이전: 입장료 30% 환불</li>
                                    <li>소개팅일자 2일 이내 또는 당일 불참: 환불 불가</li>
                                    <li>환불 소요일 : 영업일 기준으로 1~7일</li>
                                </ul>
                            </div>
                            <div class="btm-box">
                                <p class="title">카카오채널 추가 & 메시지 꼭 주세요!</p>
                                <p class="txt">[소개팅신청날짜/이름/전화번호/동행인여부/동행인이름/결제여부]</p>
                            </div>
                        </div>
                        <div class="agree-wrap form-box">
                            <div class="title-wrap col-group">
                                <p class="title">약관동의</p>
                                <label for="" @click="() => {agree1=true; agree2 = true;}">
                                    <input type="checkbox" id="" name="chk" checked v-if="agree1 && agree2">
                                    <input type="checkbox" id="" name="chk" v-else>
                                    <span class="radio-icon"></span>
                                    전체동의
                                </label>
                            </div>
                            <ul class="row-group agree-box">
                                <li>
                                    <label for="chk_1">
                                        <input type="checkbox" id="chk_1" name="chk" v-model="agree1">
                                        <span class="radio-icon"></span>
                                        환불규정을 모두 확인했으며 이에 동의 합니다
                                        <a href="/privacy02" target="_blank">
                                            <i class="xi-angle-right"></i>
                                        </a>
                                    </label>
                                </li>
                                <li>
                                    <label for="chk_2">
                                        <input type="checkbox" id="chk_2" name="chk" v-model="agree2">
                                        <span class="radio-icon"></span>
                                        개인정보 수집 및 이용에 대한 동의 (필수)
                                        <a href="/privacy01" target="_blank">
                                            <i class="xi-angle-right"></i>
                                        </a>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <button type="submit" class="submit-btn">결제하기</button>
                    </form>
                </div>
            </div>
            <!-- //파티 신청 -->
        </div>



        <div class="baytree-container">
            <div class="baytree-contents">
                <div class="baytree-box">
                    <div class="baytree-content">
                        <img src="/images/crown5.png" alt="crown5">
                        <p class="baytree-text">
                            럭셔리한 장소에서<br />
                            검증된 사람들과<br />
                            술과 음악과 함께
                        </p>
                        <p class="baytree-title">인사 파티</p>
                    </div>
                    <p class="baytree-sumtext">Insa Party</p>
                </div>
            </div>
        </div>


        <div class="application-container bg-gray">
            <div class="container">
                <div class="application-contents">
                    <img src="/images/crown4.png" alt="crown4">
                    <p class="title-num">1</p>
                    <p class="title">신청방법</p>
                    <img class="line-short" src="/images/line-short.png" alt="crown2">
                    <div class="box">
                        <span class="line"></span>
                        <div class="application-step-contents">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 01</span>
                                    <img src="/images/party-icon-01.png" alt="">
                                    <span class="step-title">회원가입</span>
                                </div>
                            </div>
                        </div>

                        <div class="application-step-contents">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 02</span>
                                    <img src="/images/party-icon-02.png" alt="">
                                    <span class="step-title">파티 신청 및 결제</span>
                                </div>
                            </div>
                        </div>

                        <div class="application-step-contents">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 03</span>
                                    <img src="/images/party-icon-03.png" alt="">
                                    <span class="step-title">신원인증</span>
                                </div>
                            </div>
                        </div>

                        <div class="application-step-contents step04">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 04</span>
                                    <img src="/images/party-icon-04.png" alt="">
                                    <span class="step-title">파티 참석</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- qualifiction -->
        <div class="application-container">
            <div class="container">
                <div class="qualifiction-contents">
                    <img src="/images/crown4.png" class="crown5" alt="crown5">
                    <p class="title-num">2</p>
                    <p class="title">참가자격</p>
                    <img class="line-short" src="/images/line-short.png" alt="crown2">
                    <div class="step-3-consult">
                        <img src="/images/matching.png" alt="matching">
                        <!-- <img src="/images/samplew.png" alt="sample1">
                        <img src="/images/samplem.png" alt="sample2"> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- qualifiction -->
        <div class="application-container">
            <div class="container">
                <div class="qualifiction-contents">
                    <img src="/images/crown2.png" alt="crown2">
                    <p class="title-num">3</p>
                    <p class="title">파티장소</p>
                    <img class="line-short" src="/images/line-short.png" alt="crown2">
                </div>
            </div>

            <!-- 슬라이드 -->
            <div class="party-place swiper-container">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(img_party, index) in product.imgs_party" :key="index">
                            <img :src="img_party.url" alt="slide-img" />
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <!-- //슬라이드 -->
            <div class="application-container bg-gray">
                <div class="container">
                    <div class="food-contents">
                        <img src="/images/crown2.png" alt="crown2">
                        <p class="title-num">4</p>
                        <p class="title">주류 및 푸드</p>
                        <img class="line-short" style="width: 264px; height:50.1px" src="/images/line-short.png" alt="crown2">
                    </div>
                </div>
                <!-- 슬라이드 -->
                <!-- <div class="container"> -->
                <div class="party-food swiper-container">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(img_food, index) in product.imgs_food" :key="index">
                                <img :src="img_food.url" alt="test image" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-button-prev">
                        <i class="xi-long-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="xi-long-arrow-right"></i>
                    </div>
                    <!-- //슬라이드 -->
                </div>
            </div>
        </div>


        <div class="progress-container">
            <div class="container">
                <div class="progress-contents">
                    <img src="/images/crown2.png" alt="crown2">
                    <p class="title-num">5</p>
                    <p class="title">진행순서</p>
                    <img class="line-short" style="width: 264px; height:50.1px" src="/images/line-short.png" alt="crown2">
                    <ul class="progress-box">
                        <li> <img clsss="progress-img" src="/images/party-step-01.png" alt="matching"></li>
                        <li> <img clsss="progress-img" src="/images/party-step-02.png" alt="matching"></li>
                        <li> <img clsss="progress-img" src="/images/party-step-03.png" alt="matching"></li>
                        <li> <img clsss="progress-img" src="/images/party-step-04.png" alt="matching"></li>
                    </ul>
                    <!-- </div> -->
                    <span class="progress-line mb"></span>
                </div>
            </div>
        </div>

        <div class="default-container">
            <div class="container">
                <div class="default-contents">
                    <img src="/images/crown2.png" alt="crown2">
                    <p class="title-num">6</p>
                    <p class="title">필수사항</p>
                    <img class="line-short" style="width: 264px; height:50.1px" src="/images/line-short.png" alt="crown2">
                </div>
                <div class="default-box">
                    <div class="debox default-1">
                        <div class="debox-cir">01</div>
                        <div class="debox-icon">
                            <img src="/images/essential-01.png" alt="essential-01">
                        </div>
                        <div class="debox-title">시간준수</div>
                        <div class="debox-content">기본적으로 파티 시작 10분전에는<br />
                            입장해주시는 것을 추천드립니다.
                        </div>
                        <div class="debox-sub">※ 남녀 파티의 컨셉으로 성비 조율로 진행되어<br />
                            &nbsp; &nbsp; 지각하거나 불참하는 경우는 없도록 부탁드리며,<br />
                            &nbsp; &nbsp; 혹시나 부득이한 경우 하루 전에 알려주세요!
                        </div>
                    </div>
                    <div class=" debox default-2">
                        <div class="debox-cir">02</div>
                        <div class="debox-icon">
                            <img src="/images/essential-02.png" alt="essential-02">
                        </div>
                        <div class="debox-title">의상</div>
                        <div class="debox-content">남녀 모두 소개팅 복장에 맞춰<br />
                            깔끔하고 예의 있는 의상을 갖춰주세요.
                        </div>
                        <div class="debox-sub">※ 여성분의 경우, 원피스나 투피스<br />
                            &nbsp; &nbsp; 스타일을 추천드립니다.
                            <br />
                            <br />
                            ※ 남성분의 경우, 수트나 셔츠류를 추천드립니다.
                        </div>
                    </div>
                    <div class="debox default-3">
                        <div class="debox-cir">03</div>
                        <div class="debox-icon">
                            <img src="/images/essential-03.png" alt="essential-03">
                        </div>
                        <div class="debox-title">매너</div>
                        <div class="debox-content">와인파티가 진행되는 동안
                            <br />
                            기본적인 매너는 지켜주세요.
                        </div>
                        <div class="debox-sub">※ 과한 주류섭취, 무례한 대화 등
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="notification-container">
            <div class="notification-contents">
                <div class="container">
<!--                    <img class="phonephoto" src="/images/kakao-phone.png" alt="phone-image">
                    <a href="http://pf.kakao.com/_kvwsxj"><img class="kakao-cir" src="/images/kakao-circle.png" alt="kakao-circle"></a>-->
                    <div class="notification-box">
                        <i class="xi-warning"></i>
                        <span class="box-title"> 필수 안내사항 </span>
                        <ul class="notification-list">
                            <li>
                                <p class="circle-num">1</p>
                                <p>파티 결제 후  <span class="text-style-1">카카오톡 플러스친구 </span>추가해주세요.</p>
                            </li>
                            <li>
                                <p class="circle-num">2</p>
                                <p><span class="text-style-1">명함이나 사원증</span>인증해주세요.<br /></p>
                            </li>
                            <li>
                                <p class="circle-num">3</p>
                                <p>카카오톡 메세지 주세요.</p>
                            </li>
                            <li>
                                <p class="circle-num">4</p>
                                <p>선착순으로 <span class="text-style-1">파티참석권</span> 승인 드립니다. </p>
                            </li>
                            <li>
                                <p class="circle-num">5</p>
                                <p>파티 참석 전에 <span class="text-style-1">환불규정</span> 확인해주세요. </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            product: this.$page.props.product.data,
            payMethods: this.$page.props.payMethods,
            form: this.$inertia.form({
                page: 1,
                product_id: this.$page.props.product.data.id,
                option_id: "",
                pay_method_id: "",
            }),
            agree1: 0,
            agree2: 0,
            active: false,
            user: this.$page.props.user.data,
        }
    },
    methods: {
        order() {
            if (!this.agree1 || !this.agree2)
                return alert("필수 약관에 동의해주세요.");

            if(!this.form.option_id)
                return alert("참가비를 선택해주세요.");

            if(!this.form.pay_method_id)
                return alert("결제수단을 선택해주세요.");

            this.form.post("/orders");
        },

        filter() {
            this.form.get("/partyProducts", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.products = page.props.products;
                }
            });
        }
    },
    computed: {
        selectedOption() {
            return this.product.options.find(option => option.id == this.form.option_id)
        },

        totalPrice() {
            if (this.selectedOption)
                return this.product.price + this.selectedOption.price;

            return 0;
        }
    },
    mounted() {
        AOS.init();

        const swiperParty = new Swiper(".party-place .swiper", {
            direction: "horizontal",
            slidesPerView: "auto",
            spaceBetween: 20,

            centeredSlides: true,

            loop: true,

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".party-place .swiper-pagination",
                clickable: true,
            },
            navigation: {
                prevEl: ".party-place .swiper-button-prev",
                nextEl: ".party-place .swiper-button-next",
            },
        });


        const swiperPartyFood = new Swiper(".party-food .swiper", {
            direction: "horizontal",
            loop: true,
            autoplay: false,
            pagination: {
                el: ".party-food  .swiper-pagination",
                clickable: true,
            },
            navigation: {
                prevEl: ".party-food  .swiper-button-prev",
                nextEl: ".party-food  .swiper-button-next",
            },
        });

    }
}
</script>
