<template>
    <div id="subpage">
        <main class="loginpage login">
            <div class="login-container main-login">
                <div class="login-header">
                    <img src="/images/footer-logo.png" alt="login-logo" class="login-logo">
                    <p class="login-header-title">우린 결국 <span class="text-style-1">만날 사람들</span>이었어</p>
                    <img class="login-line-img" src="/images/log-line.png" alt="log-line">
                    <p class="login-header-sub">
                        가장 친한 친구가 되어 찾아 줄게요
                    </p>
                </div>
            </div>
            <div class="login-wrap-main container row-group">
                <div class="login-title">
                    <h2>Log in</h2>
                </div>
                <!--  -->
                <div class="login-main">
                    <form action="" @submit.prevent="login">
                        <div class="login-form-wrap">
                            <ul class="login-form row-group">
                                <li>
                                    <input type="text" placeholder="이메일을 입력해 주세요." v-model="form.email">

                                    <div class="m-input-error">{{form.errors.email}}</div>
                                </li>
                                <li>
                                    <input type="password" placeholder="비밀번호를 입력해 주세요." v-model="form.password">

                                    <div class="m-input-error">{{form.errors.password}}</div>
                                </li>
                            </ul>
                            <button type="submit" class="login-btn">
                                로그인
                            </button>
                        </div>
                    </form>
                    <!-- //form -->
                    <ul class="find-list col-group">
                        <li>
                            <a href="/findIds/create">
                                아이디 찾기
                            </a>
                        </li>
                        <li>
                            <a href="/passwordResets/create">
                                비밀번호 찾기
                            </a>
                        </li>
                    </ul>
                    <!-- //find -->

                    <div class="login-sns col-group">
                        <div class="sns-login-wrap col-group">
                            <p>
                                SNS 계정 로그인
                            </p>
                        </div>
                        <!--  -->
                        <ul class="sns-login-list col-group">
                            <li>
                                <a href="/openLoginPop/naver" class="login-icon">
                                    <div class="login-sns-naver sns-box"><i class="xi-naver"></i></div>
                                </a>
                            </li>
                            <li>
                                <a href="/openLoginPop/kakao" class="login-icon">
                                    <div class="login-sns-kakao sns-box"><i class="xi-speech"></i></div>
                                </a>
                            </li>
                        </ul>
                        <!--  -->
                    </div>
                </div>
                <!-- //login-main -->
            </div>
            <div class="login-footer" @click="move">
                <a href="#" class="member-benefit-btn col-group" @click.prevent="">
                    <p>아직 회원이 아니신가요? <br />
                        <span>회원가입 후 다양한 서비스를 만나보세요.</span>
                    </p>

                    <i class="xi-long-arrow-right"></i>
                </a>
            </div>


        </main>
    </div>
</template>
<script>

import {Link} from "@inertiajs/inertia-vue";

export default {
    components: { Link},
    data(){
        return {
            form: this.$inertia.form({
                email:"",
                password: ""
            })
        }
    },

    methods: {
        move(){
            location.href="/register";
        },
        login() {
            this.form.post("/login", {
                preserveState: true
            })
        },

        clearLetter(){
            this.form.contact = this.form.contact.replace(/-/g, '');
        },

        ready(){
            return alert("심사 대기중입니다.");
        }
    }
}
</script>
