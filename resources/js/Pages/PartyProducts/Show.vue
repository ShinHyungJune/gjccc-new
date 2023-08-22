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
                    <div class="img-wrap">
                        <img :src="product.img_show ? product.img_show.url : ''" alt="">
                    </div>
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
                                            <p class="addr">{{ product.address }}</p>
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
                        <button class="party-request" @click="activate">파티예약</button>
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
                                            <p class="addr">{{ product.address }}</p>
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
                                            <span class="label">{{option.title}}</span>
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
                                <label for="" @click="() => {agree1=true; agree2 = true; agree3 = true;}">
                                    <input type="checkbox" id="" name="chk" checked v-if="agree1 && agree2 && agree3">
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
                                        개인정보 수집 및 이용에 대한 동의
                                        <a href="/privacy01" target="_blank">
                                            <i class="xi-angle-right"></i>
                                        </a>
                                    </label>
                                </li>
                                <li>
                                    <label for="chk_3">
                                        <input type="checkbox" id="chk_3" name="chk" v-model="agree3">
                                        <span class="radio-icon"></span>
                                        마케팅 활용에 동의 합니다
                                        <a href="/privacy04" target="_blank">
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


        <div class="container invited">
            <div class="img-wrap">
                <img class="invited-pc" src="/images/letter.jpg" alt="">
            </div>
            <div class="text-wrap">
                <div class="line"></div>
                <p>괜찮은 사람, <br />어디서 만나?</p>
            </div>
        </div>

<!--        <div class="baytree-container">
            <div class="baytree-contents">
                <div class="baytree-box">
                    <div class="baytree-content">
                        <img src="/images/crown5.png" alt="crown5">
                        <p class="baytree-text">
                            럭셔리한 장소에서<br />
                            검증된 사람들과<br />
                            술과 음악과 함께
                        </p>
                        <p class="baytree-title">만날사람들 파티</p>
                    </div>
                    <p class="baytree-sumtext">Insa Party</p>
                </div>
            </div>
        </div>-->

        <div class="container baytree">
            <div class="img-wrap">
                <img src="/images/insa-party@2x.png" alt="">
            </div>
        </div>

        <div class="application-container bg-gray fs ">
            <div class="container">
                <div class="application-contents s1">
                    <div class="crown-wrap">
                        <img src="/images/crown2.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">1</p>
                    <p class="title">신청방법</p>
                    <div class="line-wrap">
                        <img class="line-short" src="/images/line-short.png" alt="">
                    </div>
                    <ul class="box">
                        <div class="roadmap-line-box"></div>
                        <li class="application-step-contents">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 01</span>
                                    <div class="img-wrap">
                                        <img src="/images/party-icon-01@2x.png" alt="">
                                    </div>
                                    <span class="step-title">회원가입</span>
                                </div>
                            </div>
                        </li>

                        <li class="application-step-contents">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 02</span>
                                    <div class="img-wrap">
                                        <img src="/images/party-icon-02@2x.png" alt="">
                                    </div>
                                    <span class="step-title">파티 신청 및 결제</span>
                                </div>
                            </div>
                        </li>

                        <li class="application-step-contents">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 03</span>
                                    <div class="img-wrap">
                                        <img src="/images/party-icon-03@2x.png" alt="">
                                    </div>
                                    <span class="step-title">신원인증</span>
                                </div>
                            </div>
                        </li>

                        <li class="application-step-contents step04">
                            <div class="application-step-content">
                                <div class="application-step-box">
                                    <span class="step-num">step 04</span>
                                    <div class="img-wrap">
                                        <img src="/images/party-icon-04@2x.png" alt="">
                                    </div>
                                    <span class="step-title">파티 참석</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- qualifiction -->
        <div class="application-container">
            <div class="container">
                <div class="qualifiction-contents">
                    <div class="crown-wrap">
                        <img src="/images/crown2.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">2</p>
                    <p class="title">참가자격</p>
                    <div class="line-wrap">
                        <img class="line-short" src="/images/line-short.png" alt="">
                    </div>
                    <div class="step-3-consult party-person">
                        <div class="party-person-box">
                            <img src="/images/party-person-1.png" alt="">
                        </div>
                        <div class="party-person-box">
                            <img src="/images/party-person-2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- qualifiction -->
        <div class="application-container">
            <div class="container">
                <div class="qualifiction-contents">
                    <div class="crown-wrap">
                        <img src="/images/crown2.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">3</p>
                    <p class="title">파티장소</p>
                    <div class="line-wrap">
                        <img class="line-short" src="/images/line-short.png" alt="">
                    </div>
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
                        <div class="crown-wrap">
                            <img src="/images/crown2.png" class="crown2" alt="">
                        </div>
                        <p class="title-num">4</p>
                        <p class="title">주류 및 푸드</p>
                        <div class="line-wrap">
                            <img class="line-short" src="/images/line-short.png" alt="">
                        </div>
                    </div>
                </div>
                <!-- 슬라이드 -->
                <!-- <div class="container"> -->
                <div class="party-place food swiper-container">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(img_food, index) in product.imgs_food" :key="index">
                                <img :src="img_food.url" alt="slide-img" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <!-- <div class="swiper-button-prev">
                      <i class="xi-long-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next">
                      <i class="xi-long-arrow-right"></i>
                    </div> -->
                    <!-- //슬라이드 -->
                </div>
            </div>
        </div>


        <div class="progress-container">
            <div class="container">
                <div class="progress-contents">
                    <div class="crown-wrap">
                        <img src="/images/crown2.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">5</p>
                    <p class="title">진행순서</p>
                    <div class="line-wrap">
                        <img class="line-short" src="/images/line-short.png" alt="">
                    </div>
<!--                    <ul class="progress-box">
                        <li> <img clsss="progress-img" src="/images/party-step-01.png" alt="matching"></li>
                        <li> <img clsss="progress-img" src="/images/party-step-02.png" alt="matching"></li>
                        <li> <img clsss="progress-img" src="/images/party-step-03.png" alt="matching"></li>
                        <li> <img clsss="progress-img" src="/images/party-step-04.png" alt="matching"></li>
                    </ul>-->
                    <!-- </div> -->
                    <ul>
                        <li>
                            <img src="/images/party-step-02@2x.png" alt="">
                        </li>
                        <li>
                            <img src="/images/party-step-022@2x.png" alt="">
                        </li>
                        <li>
                            <img src="/images/party-step-03@2x.png" alt="">
                        </li>
                    </ul>
                    <div class="roadmap-line-box"></div>
                    <span class="progress-line mb"></span>
                </div>
            </div>
        </div>

        <div class="default-container">
            <div class="container">
                <div class="default-contents">
                    <div class="crown-wrap">
                        <img src="/images/crown2.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">6</p>
                    <p class="title">기본매너</p>
                    <div class="line-wrap">
                        <img class="line-short" src="/images/line-short.png" alt="">
                    </div>
                </div>
                <div class="default-box">
                    <div class="debox default-1">
                        <div class="debox-cir">01</div>
                        <div class="debox-icon">
                            <img src="/images/essential-01.png" alt="essential-01">
                        </div>
                        <div class="debox-title">시간준수</div>
                        <div class="debox-content" v-text="product.manner_time_title"></div>
                        <div class="debox-sub">
                            <p class="body" v-if="product.manner_time_comment1">{{product.manner_time_comment1}}</p>
                            <p class="body" v-if="product.manner_time_comment2">{{product.manner_time_comment2}}</p>
                            <p class="body" v-if="product.manner_time_comment3">{{product.manner_time_comment3}}</p>
                        </div>
                    </div>
                    <div class=" debox default-2">
                        <div class="debox-cir">02</div>
                        <div class="debox-icon">
                            <img src="/images/essential-02.png" alt="essential-02">
                        </div>
                        <div class="debox-title">의상</div>
                        <div class="debox-content" v-text="product.manner_cloth_title"></div>
                        <div class="debox-sub">
                            <p class="body" v-if="product.manner_cloth_comment1">{{product.manner_cloth_comment1}}</p>
                            <p class="body" v-if="product.manner_cloth_comment2">{{product.manner_cloth_comment2}}</p>
                            <p class="body" v-if="product.manner_cloth_comment3">{{product.manner_cloth_comment3}}</p>
                        </div>
                    </div>
                    <div class="debox default-3">
                        <div class="debox-cir">03</div>
                        <div class="debox-icon">
                            <img src="/images/essential-03.png" alt="essential-03">
                        </div>
                        <div class="debox-title">매너</div>
                        <div class="debox-content" v-text="product.manner_attitude_title"></div>
                        <div class="debox-sub">
                            <p class="body" v-if="product.manner_attitude_comment1">{{product.manner_attitude_comment1}}</p>
                            <p class="body" v-if="product.manner_attitude_comment2">{{product.manner_attitude_comment2}}</p>
                            <p class="body" v-if="product.manner_attitude_comment3">{{product.manner_attitude_comment3}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="notification-container">
            <div class="notification-contents">
                <div class="container">
<!--                    <img class="phonephoto" src="/images/kakao-phone@2x.png" alt="phone-image">
                    <a href="http://pf.kakao.com/_kvwsxj"><img class="kakao-cir" src="/images/kakao-circle.png" alt="kakao-circle"></a>-->
                    <div class="notification-box">
                        <i class="xi-warning"></i>
                        <span class="box-title">필수사항</span>
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
            agree3: 0,
            active: false,
            user: this.$page.props.user ? this.$page.props.user.data : "",
        }
    },
    methods: {
        activate(){
            if(this.user)
                return this.active = true;

            return location.href="/login";
        },

        order() {
            if (!this.agree1 || !this.agree2 || !this.agree3)
                return alert("약관에 동의해주세요.");

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

        $(".party-food .swiper-slide img").each(function(item, index){
            console.log(item);
        });

        const swiperParty = new Swiper(".party-place .swiper", {
            direction: "horizontal",
            slidesPerView: "auto",
            spaceBetween: 20,

            loop: true,

            centeredSlides: true,

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
    }
}
</script>
