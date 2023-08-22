<template>
    <main class="subpage result-section">
        <div class="result-container">
            <div class="result-contents">
                <div class="check-icon">
                    <i class="xi-check"></i>
                </div>
                <p class="result-title" v-if="ids.length > 0">
                    고객님의 아이디는 <span class="text-style-1" v-for="id in ids" :id="id">{{id}}</span> 입니다.
                </p>
                <p class="result-title" v-else>
                    해당 전화번호로 가입된 이력이 없습니다.
                </p>
                <div class="result-sub">
                    <p>비밀번호가 기억나지 않으신가요?</p>
                    <a href="/passwordResets/create" class="text-style-1">비밀번호 재설정하기</a>
                </div>
                <a href="/login" class="btn-result" style="display: flex; align-items: center; justify-content: center;">로그인 페이지로 가기</a>
            </div>
        </div>

    </main>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link, },
    data(){
        return {
            ids: this.$page.props.ids,
        }
    },

    methods: {

    }
}
</script>
