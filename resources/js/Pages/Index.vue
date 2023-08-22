<template>
    <main class="mainpage">
        <div class="pop-parent" id="popParent" v-if="activePop && pops.data.length > 0">
            <div class="pop">
                <div class="swiper">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <a :href="pop.url ? pop.url : '#'" class="swiper-slide" v-for="pop in pops.data" :key="pop.id">
                                <div class="m-ratioBox-wrap">
                                    <div class="m-ratioBox" :style="`background-image:url(${pop.img ? pop.img.url : ''}); background-size:cover; background-position:center;`"></div>
                                </div>
                            </a>
                        </div>

                        <div class="swiper-control">
                            <div class="swiper-pagination"></div>

                            <button class="swiper-btn-control">
                                <div class="icon_stop" title="슬라이더 자동재생 멈춤">
                                    <span class="stick stick01"></span>
                                    <span class="stick stick02"></span>
                                </div>

                                <div class="icon_play" title="슬라이더 자동재생 시작"></div>
                            </button>
                        </div>
                    </div>

                    <div class="pop-btns">
                        <!-- <a href="#a" id="popupToday" class="btnDivPopClose"><span class="icon"></span> 오늘하루 보지 않기</a> -->
                        <input type="checkbox" name="oneday" id="oneday_check" @click="closeToday()">
                        <label for="oneday_check" @click="closeToday()">
                            <span class="icon"></span> 오늘하루 보지 않기
                        </label>


                        <!-- <input type="checkbox" id="popupToday"> <label for="popupToday">오늘하루 열지않음</label> -->
                        <button class="btn-toggle">
                            <i class="xi-angle-up" style="color:#fff;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- main-banner  -->
        <div class="main-banner">
            <div class="main-banner-box">
                <div class="subpage-under">
                    <span class="subpage-under-text">The most important thing in life is love</span>
                </div>
                <div class="banner-contents">
                    <div class="banner-title">
                        <h2 class="col-group pc">
<!--                <span class="text-style-1">
                  인
                </span>-->
                            <span class="toggle_txt toggle_txt1">
                  우린 결국
                </span>
                            <span class="text-style-1">
                  만날사람들
                </span>
                            <span class="toggle_txt toggle_txt2">
                  이었어
                </span>
                        </h2>
                        <div class="mb">
                            <h2 class="col-group">
                  <span class="toggle_txt toggle_txt2">
                    우린 결국 &nbsp;
                  </span>
                                <span class="text-style-1">
                    만날사람들
                  </span>
                                <span class="toggle_txt toggle_txt3">
                    이었어
                  </span>
                            </h2>
                        </div>
                    </div>
                    <p class="banner-text">소개팅앱은 가볍고 결정사는 올드해
                        <br/>그렇다면 시작하세요
                    </p>
                    <a class="join-button" href="/register">
                        <span>가입신청</span><i class="xi-long-arrow-right"></i>
                    </a>
                </div>
                <img src="/images/main-visual.png" alt="main-visual" class="main-visual">
            </div>

        </div>

        <div class="main-section sec-2" data-aos="fade-left" data-aos-duration="3000" data-aos-anchor-placement="top-bottom" data-aos-delay="2">
            <!-- <div class="main-section sec-1"> -->
            <div class="container">
                <div class="main-date" aos-data="left">
                    <div class="img-wrap">
                        <img src="/images/main-date.png" alt="main-date">
                    </div>
                    <div class="left">
                        <span class="left-title"><span class="text-style-1">D</span>ate</span>
                        <p class="left-content">
                            조건, 성향 등을 고려해서 매칭해주는 소개팅 서비스로<br />
                            <span class="text-style-1">'원하는 만남'</span>의 기회를 제공합니다.
                        </p>
                        <div class="top-roadMap">
                            <ul class="roadmap roadmap-list-1">
                                <li>사전 상담</li>
                                <li>프로필 작성</li>
                                <li class="full">소개팅</li>
                                <li>프로필 교환</li>
                            </ul>
                            <div class="roadmap-line-box"></div>
                            <ul class="roadmap roadmap-list-2">
                                <li>컨설팅</li>
                                <li>피드백</li>
                                <li>소개팅</li>
                                <li>일정 조율</li>
                            </ul>
                        </div>
                        <a class="main-button style1" href="/datingProducts">
                            <span>신청하기</span><i class="xi-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-section sec-1" data-aos="fade-right" data-aos-duration="3000" data-aos-anchor-placement="top-bottom" data-aos-delay="2">
            <!-- <div class="main-section sec-2"> -->
            <div class=" container">
                <div class="main-party">
                    <div class="img-wrap">
                        <img src="/images/main-party.png" alt="main-party">
                    </div>
                    <div class="left">
                        <span class="left-title"><span class="text-style-1">P</span>arty</span>
                        <p class="left-content">
                            연령과 성비를 조율한 파티 서비스로<br />
                            <span class="text-style-1">'자연스러운 만남'</span> 의 기회를 제공합니다
                        </p>
                        <div class="left-roadMap">
                            <span class="roadmap-line"></span>
                            <ul class="roadmap-list">
                                <li>파티신청</li>
                                <li>신원인증</li>
                                <li>참석권 수령</li>
                                <li class="full">파티참석</li>
                            </ul>
                        </div>
                        <!-- <button class="main-button"> -->
                        <a class="main-button style1" href="/partyProducts">
                            <span>신청하기</span><i class="xi-long-arrow-right"></i>
                        </a>
                        <!-- </button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="main-section sec-4">
            <div class="sec4-container">
                <div class="main-content">
                    <div class="container">
                        <div class="img-wrap main-talk">
                            <img src="/images/main-talk.png" alt="">
                        </div>
                        <div class="img-wrap main-talk mb">
                            <img src="/images/main-talk-m.png" alt="">
                        </div>
                        <!-- 0724 -->
                        <div class="warning-container-pc pc">
                            <div class="img-wrap">
                                <img src="/images/main-table-07.png" alt="">
                            </div>
                        </div>
                        <!-- // -->
                        <div class="warning-container mb">
                            <div class="warning-img">
                                <img src="/images/main-warning.png" />
                            </div>
                            <div class="scroll-img">
                                <img src="/images/scroll.png" alt="">
                            </div>
                        </div>
                        <div class="warning-container mb">
                            <div class="swiper-container">
                                <div class="swiper-wrapper" >
                                    <div class="swiper-slide">
                                        <img src="/images/main-table-01.png" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/images/main-table-02.png?v=1" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/images/main-table-03.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-bg pc">
                            <div class="crown-wrap type1">
                                <img src="/images/crown1.png" alt="" class="crown1">
                            </div>
                            <div class="content-container">
                                <div class="banner-title btm">
                                    <h2 class="content-title col-group pc">
                                        <span class="toggle_txt contenttxt1">
                        우린 결국
                      </span>
                                        <span class="text-style-1">
                        만날 사람들
                      </span>
                                        <!-- <span class="toggle_txt toggle_txt2"> -->
                                        <span class="toggle_txt contenttxt2">
                        이었어
                      </span>
                                    </h2>
                                </div>
                            </div>
                            <p class="content-sub pc">가장 친한 친구가 되어 찾아드립니다.</p>
                            <a href="/datingProducts" class="button-soge">올인원 프라이빗 소개팅</a>
                        </div>
                    </div>
                    <div class="container mb">
                        <div class="content-container">
                            <div class="crown1-img">
                                <img src="/images/crown1.png" alt="" class="crown1">
                            </div>
                            <div class="banner-title">
                                <div class="mb">
                                    <h2 class="col-group col-group01">
                                        <span class="toggle_txt toggle_txt1 btm">
                        우린 결국
                      </span>
                                    </h2>
                                    <h2 class="col-group">
                      <span class="text-style-1">
                          만날 사람들
                      </span>
                                        <span class="toggle_txt toggle_txt3 btm">
                        이었어
                      </span>
                                    </h2>
                                </div>
                            </div>
                            <p class="content-sub mb">가장 친한 친구가 되어 찾아드립니다.</p>
                            <a href="/datingProducts" class="button-soge">올인원 프라이빗 소개팅</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- MAIN-SERVICE -->
        <div class="main-section sec-5">
            <div class="container">
                <div class="row-group">
                    <div class="main-service">
                        <div class="service-title">
                            <div class="crown-wrap">
                                <img src="/images/crown5.svg" alt="" class="crown5">
                            </div>
                            <span class="title-style-1">All IN ONE</span>
                            <span class="title-style-2">PRIVATE</span>
                            <span class="title-style-3">SERVICE</span>
                        </div>
                        <div class="service-explan">
            <pre>누군가 만날 준비된 당신.
              쉽게 가볍게 만나기엔 어려운 당신.
              비싼 돈을 지불하기엔 소중한 당신.

              '만날사람들'은 준비된 분들을 위한 서비스입니다.
              만날사람들은 나를 지키면서, 나를 위한 1:1 프리미엄,
              프라이빗 서비스를 제공하는 <br class="mb" /> 온·오프라인 융합 서비스입니다.

              모든 것이 디지털화된 지금,<br class="mb" />  절대 디지털화 할 수 없는 것이 있습니다.
              바로 사람과의 관계입니다.

              더이상 가벼운 만남으로 감정소모 하지 않아도,
              고가의 비용을 지불하지 않아도 됩니다.
              최고의 고객서비스를 제공하여<br class="mb" />  최고의 만족도를 만들어 드리겠습니다.</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN-Choice -->
        <div class="main-section sec-6">
            <div class="container">
                <div class="row-group">
                    <div class="main-choice">
                        <div class="choice-title">
                            <div class="crown-wrap">
                                <img src="/images/crown2.png" alt="" >
                            </div>
                            <p>만날사람들을 <br /><span class="text-style-1">선택</span>해야하는 이유</p>
                        </div>
                        <ul class="choice-container">
                            <li class="img-wrap">
                                <img src="/images/reason-01.png" alt="reason1" />
                            </li>
                            <li class="img-wrap">
                                <img src="/images/reason-02.png" alt="reason1" />
                            </li>
                            <li class="img-wrap">
                                <img src="/images/reason-03.png" alt="reason1" />
                            </li>
                        </ul>
                        <div class="line-wrap">
                            <img src="/images/line.png" alt="" class="line hidden-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- main-only -->
        <div class="main-section sec-7">
            <div class="container">
                <div class="row-group">
                    <div class="main-only">
                        <div class="only-title">
                            <div class="crown-wrap">
                                <img src="/images/crown2.png" alt="" >
                            </div>
                            <p><span class="text-style-1">오직</span><br />만날사람들에만 있는 것</p>
                        </div>
                        <div class="only-container">
                            <ul class="only-list">
                                <li>
                                    <span class="cir s-1"></span>
                                    <span class="cirb b-1">01</span>
                                    <b>진정성</b> 있는 만남을 원하는 사람만 가입</b>
                                </li>
                                <li>
                                    <span class="cir s-2"></span>
                                    <span class="cirb b-2">02</span>
                                    <b>대면 상담</b>으로 철저한 검증
                                </li>
                                <li>
                                    <span class="cir s-3"></span>
                                    <span class="cirb b-3">03</span>
                                    남녀 <b>동일한 비용</b>
                                </li>
                                <li>
                                    <span class="cir s-4"></span>
                                    <span class="cirb b-4">04</span>
                                    디테일한 <b>매칭 회의</b>
                                </li>
                                <li>
                                    <span class="cir s-5"></span>
                                    <span class="cirb b-5">05</span>
                                    매너, 호감도를 체크하면서 <b>사후관리</b>까지 책임
                                </li>
                                <li>
                                    <span class="cir s-6"></span>
                                    <span class="cirb b-6">06</span>
                                    <b>알바 회원 없음</b>
                                </li>
                                <li>
                                    <span class="cir s-7"></span>
                                    <span class="cirb b-7">07</span>
                                    온 &middot; 오프라인 서비스 동시 운영으로 <b>신뢰감</b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer-Banner -->
        <div class="main-section sec-8">
            <div class="main-footer container">
                <div class="main-footer-content">
                    <p>사람은 만나봐야 알 수 있고<br />
                        사랑은 만나봐야 느낄 수 있어<br />
                        사랑에 더 이상 우연은 없어</p>
                    <a href="/register">
                        <p class="main-footer-btn">가입신청</p>
                        <img class="arrow-off" src="/images/arrow.png" alt="arrow-on">
                        <img class="arrow-on" src="/images/arrow-on.png" alt="arrow-on">
                    </a>
                </div>
            </div>
        </div>

    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';


export default {
    components: { Link},

    data() {
        return {
            activePop: true,
            pops: this.$page.props.pops ? this.$page.props.pops : "",
        }
    },

    methods: {
        closeToday() {
            window.localStorage.setItem("closed_at", JSON.stringify(new Date()));

            this.activePop = false;
        },

        closePop() {
            this.activePop = false;
        },

        checkToday(date){
            let today = new Date();

            if(date.getFullYear() !== today.getFullYear())
                return false;

            if(date.getMonth() !== today.getMonth())
                return false;

            if(date.getDate() !== today.getDate())
                return false;

            return true;
        },
    },

    mounted() {
        AOS.init();

        const swiper = new Swiper('.warning-container .swiper-container', {
            slidesPerView: "auto",
            freeMode: true,
            initialSlide:1,
        });

        let closedAt = window.localStorage.getItem("closed_at");

        if(closedAt && this.checkToday(new Date(JSON.parse(closedAt))))
            this.activePop = false;

        $(".pop-parent .btn-toggle").click(function () {
            $(".pop-parent").toggleClass("active");
        });

        new Swiper('.pop-parent .swiper-container', {
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
    }
}
</script>
