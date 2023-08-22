<template>
    <header id="header">
        <div class="header-wrap sitemap">
            <div class="top-menu">
                <ul class="top-menu-sns">
                    <li class="sns-icons">
                        <a href="https://www.instagram.com/manalsaramdl/" target="_blank"><img class="sns-icon insta-off" src="/images/sns-icon-insta%20(1).svg" /></a>
                        <a href="https://www.instagram.com/manalsaramdl/" target="_blank"><img class="sns-icon insta-on" src="/images/sns-icon-insta-on.svg" /></a>
                    </li>
                    <li>
                        <a href="https://blog.naver.com/insa_official" target="_blank"> <i class="sns-icon naver xi-naver"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UCyZXDjRBTHtc6XM2ayGpWzQ" target="_blank"> <i class="sns-icon youtube xi-youtube-play"></i></a>
                    </li>
                </ul>
                <h1 class="logo">
                    <a href="/"></a>
                </h1>
                <div class="top-login" v-if="!$page.props.user">
                    <ul>
                        <li><a href="/login">Log in</a></li>
                        <li><a href="/register">Sign up</a></li>
                    </ul>
                </div>
                <div class="top-login" v-else>
                    <ul>
                        <li><a href="/logout">Logout</a></li>
                        <li><a href="/datings" :class="$page.props.user && $page.props.user.data.alarm ? 'point' : ''">Mypage</a></li>
                    </ul>
                </div>
                <div class="menu-bar">
                    <button class="mb-hd-open"><img src="/images/m-bar.png" alt=""></button>
                </div>
            </div>
        </div>
        <nav class="gnb-wrap">
            <ul class="gnb">
                <li class="active">
                    <a href="/story">만날 사람들</a>
                    <!-- <div class="subA"> -->
                    <ul class="gnb-sub a">
                        <li>
                            <a href="/story">탄생배경</a>
                        </li>
                    </ul>
                    <!-- </div> -->
                </li>
                <li>
                    <a href="/partyProducts">서비스</a>
                    <ul class="gnb-sub b">
                        <li><a href="/datingProducts">소개팅신청</a></li>
                        <li><a href="/partyProducts">파티신청</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/datingReviews">후기</a>
                    <ul class="gnb-sub c">
                        <li><a href="/datingReviews">소개팅 후기</a></li>
                        <li><a href="/partyReviews">파티 후기</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/commentNotices">게시판</a>
                    <ul class="gnb-sub d">
                        <li><a href="/commentNotices">만날사람들의 코멘트</a></li>
                        <li><a href="/datingNotices">소개팅Q&A</a></li>
                        <li><a href="/partyNotices">파티Q&A</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="mb-hd mb">
            <div class="mb-hd-wrap ">
                <div class="mb-hd-box">
                    <div class="mb-logo">
                        <img src="/images/footer-logo.png" alt="insa-logo">
                    </div>
                    <div class="mb-login" v-if="!$page.props.user">
                        <a href="/login">login</a>
                        <!--
                        <a href="/datings">mypage</a>
                        -->
                        <a href="/register">sign in</a>
                    </div>
                    <div class="mb-login" v-else>
                        <a href="/logout">logout</a>
                        <a href="/datings">mypage</a>
                    </div>
                    <ul class="mb-nav">
                        <li>
                            <div class="mb-sm-nav-top">
                                <a href="/story">만날사람들</a>
                                <i class="xi-angle-down"></i>
                            </div>
                            <div class="mb-sm-nav" style="display: none;">
                                <a href="/story">탄생 배경</a>
                            </div>
                        </li>
                        <li>
                            <div class="mb-sm-nav-top">
                                <a href="/partyProducts">서비스</a>
                                <i class="xi-angle-down"></i>
                            </div>
                            <div class="mb-sm-nav">
                                <a href="/datingProducts">소개팅 신청</a>
                                <a href="/partyProducts">파티 신청</a>
                            </div>
                        </li>
                        <li>
                            <div class="mb-sm-nav-top">
                                <a href="/datingReviews">후기</a>
                                <i class="xi-angle-down"></i>
                            </div>
                            <div class="mb-sm-nav">
                                <a href="/datingReviews">소개팅 후기</a>
                                <a href="/partyReviews">파티 후기</a>
                            </div>
                        </li>
                        <li>
                            <div class="mb-sm-nav-top">
                                <a href="/commentNotices">게시판</a>
                                <i class="xi-angle-down"></i>
                            </div>
                            <div class="mb-sm-nav">
                                <a href="/commentNotices">만날사람들의 코멘트</a>
                                <a href="/datingNotices">소개팅Q&A</a>
                                <a href="/partyNotices">파티Q&A</a>
                            </div>
                        </li>
                    </ul>
                    <div class="sns-wrap-mb">
<!--                        <a href="/logout" class="logout-btn" v-if="$page.props.user">logout<i class="xi-log-out"></i></a>-->
                        <a href="https://www.instagram.com/manalsaramdl/" target="_blank"> <i class="insta xi-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCyZXDjRBTHtc6XM2ayGpWzQ" target="_blank"> <i class="utb youtube xi-youtube-play"></i></a>
<!--                        <a href="https://pf.kakao.com/_kvwsxj" target="_blank"> <i class="kakao speech xi-speech"></i></a>-->
                        <a href="https://blog.naver.com/insa_official" target="_blank"> <i class="sns-icon naver xi-naver"></i></a>
                    </div>
                    <button class="close-btn">
                        <i class="xi-close"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
export default {
    components: {Link},
    data(){
        return {
            pathname: location.pathname,

            user: this.$page.props.user ? this.$page.props.user.data : "",
            form: this.$inertia.form({
                word: ""
            }),
        }
    },
    methods: {
        search(){

        },

        init(){
            // 모달된 스크롤 막기
            /*$("*").click(function(){
                if($('.modal-overley').hasClass('open'))
                    return $('html, body').css({'position':'fixed','overflow':'hidden'});

                return $('html, body').css({'position':'inherit', 'overflow':'auto'});
            });*/


            $(function () {
                $(".menu-bar").click(function () {
                    if($(".mb-hd-wrap").hasClass("open") === true){
                        $(".mb-hd-wrap").removeClass("open");
                        $(".nav-wrap").addClass("open");
                        $(".close-btn").click(function () {
                            $(".nav-wrap").removeClass("open");
                        });
                    }else{
                        $(".nav-wrap").removeClass("open");
                        $(".mb-hd-wrap").addClass("open");
                        $(".close-btn").click(function () {
                            $(".mb-hd-wrap").removeClass("open");
                        });
                    }
                });
            });

            $(function () {
                let $sm_nav_top = $(".mb-sm-nav-top");
                $sm_nav_top.click(function () {
                    $(this).siblings(".mb-sm-nav").slideToggle();
                    $(this).toggleClass("active");
                });
            });
        }
    },
    computed: {

    },

    mounted() {
        this.init();

        this.$inertia.on("start", () => {
            this.pathname = location.pathname;
        });

    }
}
</script>
