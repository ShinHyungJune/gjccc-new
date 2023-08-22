<template>
    <main class="join find-id find-pw">
        <div class="join-wrap container">
            <div class="sec-title-wrap col-group">
                <div class="sec-title">
                    <h2>
                        <span>만날사람들</span>
                        비밀번호 초기화
                    </h2>
                    <p>
                        비밀번호를 초기화하려는 아이디를 <br/>가입했던 휴대폰번호와 함께 입력해주세요.
                    </p>
                </div>
            </div>

            <div class="sec-con">
                <form action="">
                    <input type="text" placeholder="아이디를 입력해주세요." v-model="form.ids">

                    <div class="m-input-error">{{form.errors.ids}}</div>

                    <div style="margin-top:16px;"></div>

                    <input-verify-number @verified="(data) => form.contact = data" />

                    <div class="m-input-error">{{form.errors.contact}}</div>
                </form>
            </div>

            <!-- <button type="submit" class="next-btn">
                다음
            </button> -->

            <a href="#" class="next-btn" @click="store" style="width:200px;">
                비밀번호 초기화
            </a>
        </div>
    </main>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue";
import InputVerifyNumber from "../../Components/Form/InputVerifyNumber";

export default {
    components: {InputVerifyNumber, Link},
    data(){
        return {
            agree: 0,
            form: this.$inertia.form({
                ids: "",
                contact: ""
            })
        }
    },

    methods: {
        store() {
            this.form.post("/passwordResets");
        },


    }
}
</script>
