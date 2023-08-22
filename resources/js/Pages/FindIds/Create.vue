<template>
    <main class="mypage join join2">
        <div class="join-wrap container">
            <div class="sec-title-wrap col-group">
                <div class="sec-title"><h2><span>만날사람들</span>
                    아이디찾기
                </h2>
                    <p>
                        회원가입시 입력했던 휴대폰번호로 아이디를 찾을 수 있습니다.
                    </p></div>
            </div>
            <div class="sec-con"><h3>
                회원정보
            </h3>
                <ul class="mypage-form">
                    <li class="col-group"><p class="default">
                        연락처
                    </p>
                        <div class="user">
                            <div class="col-group">
                                <input-verify-number @verified="(data) => search(data)" />
                            </div>
                            <p class="m-input-error"></p>
                        </div>
                    </li>
                </ul>
                <div class="btn-wrap col-group">
                    <a href="javascript:history.back()">취소</a>
                </div>
            </div>
        </div>
    </main>

</template>
<script>
import {Link} from "@inertiajs/inertia-vue";
import InputVerifyNumber from "../../Components/Form/InputVerifyNumber";

export default {
    components: {InputVerifyNumber, Link,},
    data() {
        return {
            agree: 0,
            form: this.$inertia.form({
                contact: "",
            })
        }
    },

    methods: {
        search(data) {
            this.form.contact = data;

            this.form.get("/findIds/search");
        },


    }
}
</script>
