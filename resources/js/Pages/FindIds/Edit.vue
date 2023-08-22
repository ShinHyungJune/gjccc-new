<template>
    <main class="mypage join join2">
        <div class="join-wrap container">
            <div class="sec-title-wrap col-group">
                <div class="sec-title">
                    <h2>
                        <span>흙표흙침대</span>
                        아이디찾기
                    </h2>
                    <p>
                        회원가입시 입력했던 휴대폰번호로 <br/>아이디를 찾을 수 있습니다.
                    </p>
                </div>
            </div>

            <div class="sec-con">
                <h3>
                    회원정보
                </h3>
                <ul class="mypage-form">
                    <li class="col-group">
                        <p class="default">
                            연락처
                        </p>

                        <div class="user">
                            <div class="col-group">
                                <input-verify-number @verified="(data) => search(data)" />
                            </div>

                            <p class="m-input-error">{{ form.errors.contact }}</p>
                        </div>
                    </li>
                </ul>
                <div class="btn-wrap col-group">
                    <a href="javascript:history.back()">
                        취소
                    </a>
                </div>
            </div>
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
