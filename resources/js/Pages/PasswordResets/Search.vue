<template>
    <main class="mypage join join2 find-id">
        <div class="join-wrap container">
            <div class="txt-box row-group">
                <i class="xi-check-circle-o"></i>
                <h2>
                    김흙표님의 아이디는
                    <span v-for="id in ids" :id="id">ABCE123 </span>
                    입니다.
                </h2>
                <p>
                    비밀번호가 기억나지 않으신가요?
                    <a href="/shopping/passwordResets/create">
                        비밀번호 재설정하기
                    </a>
                </p>
            </div>
            <a href="/shopping" class="home-btn">
                홈으로 가기
            </a>
        </div>
    </main>
</template>
<script>
import InputVerifyNumber from "../../../Components/Form/InputVerifyNumber";
import {Link} from "@inertiajs/inertia-vue";
import InputAddress from "../../../Components/Form/InputAddress";

export default {
    components: {InputAddress, Link, InputVerifyNumber},
    data(){
        return {
            ids: this.$page.props.ids,
        }
    },

    methods: {

    }
}
</script>
