<template>
    <main class="loginpage pwd-new">
        <div class="login-wrap">
            <div class="login-contants" style="padding:60px 0;">
                <p class="login-title"><span class="text-style-1">만날사람들 &nbsp;</span>비밀번호 찾기</p>
                <p class="login-title-sub">새로운 비밀번호를 등록해주세요.</p>
                <div class="login-line"></div>
                <div class="login-pwd-lost">
                    <!-- 일치하는 정보에 따른 변화 작성 해야함.-->
                    <input class="pwd-input" type="text" placeholder="새로운 비밀번호를 입력해주세요." v-model="form.password">
                    <input class="pwd-input" type="text" placeholder="비밀번호 확인" v-model="form.password_confirmation">
<!--                    <p class="pwd-sub">영문, 숫자, 특수문자를 포함 8~ 30자리로 입력해주세요.</p>-->
                    <br class="mb" />
                    <p class="pwd-sub">비밀번호는 대소문자를 구분합니다.</p>
                    <div class="btn-box">
                        <button class="btn-next" @click.prevent="update">초기화</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

</template>
<script>
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link},
    data(){
        return {
            agree: 0,
            form: this.$inertia.form({
                token: this.$page.props.token,
                password: "",
                password_confirmation: ""
            })
        }
    },

    methods: {
        update() {
            this.form.patch("/passwordResets");
        },


    }
}
</script>
