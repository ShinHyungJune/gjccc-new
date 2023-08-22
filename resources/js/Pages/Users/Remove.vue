<template>
    <main class="subpage mypage mypage_leave">

        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Mypage</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 마이페이지</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 회원 탈퇴</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mypage-wrap col-group">

            <sidebar />

            <div class="right-wrap">
                <div class="title-wrap col-group">
                    <h2>회원 탈퇴</h2>
                </div>
                <div class="con-wrap">
                    <div class="txt-box">
                        <h3 class="title">
                            <i class="xi-lock"></i>
                            회원 탈퇴
                        </h3>
                        <p class="txt">
                            만날사람들 회원에서 탈퇴 하시면 가입하신<br class="mb"> 회원정보, 프로필, 결제내역, 소개팅 내역, <br>
                            파티 내역등이 모두 초기화 되며, 복구하실 수 없습니다. <br>
                            정말로 탈퇴를 원하신다면 아래 탈퇴 버튼을 눌러주세요. <br>
                            회원탈퇴 후 [30일간 재가입이 불가합니다.]
                        </p>
                    </div>
                    <button type="button" @click="check" class="leave-btn">탈퇴하기</button>
                </div>

<!--                <a href="http://pf.kakao.com/_kvwsxj" class="kakao-btn">
                    <img class="kakao-cir" src="/images/kakao-circle.png" alt="kakao-circle">
                </a>-->
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";
import Sidebar from "../../Components/Sidebar";

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {
            agree: 0,
            form: this.$inertia.form({
                page: 1,
                password: ""
            })
        }
    },
    methods:{
        check(){
            let result = confirm('정말로 탈퇴하시겠습니까?');

            if(result)
                this.remove();
        },

        remove(){
            this.form.delete("/users", {
                onSuccess: () => {

                }
            });
        }
    }
}
</script>
