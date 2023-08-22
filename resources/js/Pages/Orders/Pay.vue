<template>
    <div class="orders-pay" style="min-height:1000px;">
        <h3 class="title animated flash infinite">결제 진행중...</h3>
    </div>
</template>
<script>

import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link},

    data() {
        return {
            form: this.$inertia.form({
                imp_uid: "",
                merchant_uid: ""
            }),

            resultForm: this.$inertia.form({
                message: "",
                order_id: ""
            }),

            order: this.$page.props.order.data
        }
    },

    methods: {
        pay(){
            let self = this;
            let IMP = window.IMP; // 생략가능

            IMP.init(this.$page.props.imp_code); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

            IMP.request_pay({
                pg : this.order.pay_method_pg, // version 1.1.0부터 지원.
                pay_method : this.order.pay_method_method,
                merchant_uid : this.order.merchant_uid,
                name : this.order.products[0].title,
                amount : this.order.price,
                buyer_name : this.order.user_name,
                buyer_tel : this.order.user_contact,
                buyer_email : this.order.user_email,
                buyer_addr : '',
                buyer_postcode : '',
                m_redirect_url: this.$page.props.m_redirect_url
            }, function(rsp) {
                if ( rsp.success ) {
                    self.form.imp_uid = rsp.imp_uid;
                    self.form.merchant_uid = rsp.merchant_uid;

                    self.form.post("/orders/complete", {
                        replace:true
                    });
                } else {
                    let msg = '에러내용 : ' + rsp.error_msg;

                    self.resultForm.message = msg;
                    self.resultForm.order_id = self.order.id;

                    alert(msg);

                    self.resultForm.get("/orders/fail", {
                        replace:true
                    })
                }
            });
        }
    },

    mounted(){
        this.pay();
    }
}
</script>
