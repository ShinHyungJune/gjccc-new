<template>
    <main class="subpage blind-date pay-result">
        <!-- banner  -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Service</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">서비스</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">소개팅 신청</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-container">
            <div class="container">
                <!-- 결제완료 -->
                <div class="result-wrap">
                    <div class="title-wrap only" v-if="order.state === 'SUCCESS'">
                        <h2 class="title">
                            결제완료
                        </h2>
                        <p class="txt"></p>
                    </div>
                    <div class="title-wrap only" v-else-if="order.state === 'WAIT'">
                        <h2 class="title">
                            결제대기
                        </h2>
                        <p class="txt"></p>
                    </div>
                    <div class="title-wrap only" v-else>
                        <h2 class="title" style="color:red;">
                            결제실패
                        </h2>
                        <p class="txt" style="margin-top:8px;">{{order.reason}}</p>
                    </div>

                    <div class="m-table-wrap" v-if="order.vbank_num">
                        <h3 class="m-table-title">가상계좌 입금기한 내 입금완료 시 정상결제처리됩니다.</h3>
                        <table class="m-table type01">
                            <tbody>
                            <tr>
                                <th>은행명</th>
                                <td>{{order.vbank_name}}</td>
                            </tr>
                            <tr>
                                <th>계좌번호</th>
                                <td>{{order.vbank_num}}</td>
                            </tr>
                            <tr>
                                <th>입금기한</th>
                                <td>{{order.vbank_date}}</td>
                            </tr>
                            <tr>
                                <th>입금금액</th>
                                <td>{{order.price.toLocaleString()}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="txt-box">
                        인사와 함께해 주셔서 감사합니다. <br>
                        전담 매니저가 1~2영업일 이내에 연락드리겠습니다.
                    </div>
                    <div class="btn-wrap">
<!--                        <a href="http://pf.kakao.com/_kvwsxj" class="submit-btn chat">1:1 상담 바로가기</a>-->
                        <a href="/" class="submit-btn back">메인으로</a>
                    </div>
                </div>
            </div>
            <!-- //결제완료 -->
        </div>
    </main>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link, Pagination},

    data() {
        return {
            order: this.$page.props.order.data,
        }
    },

    methods: {

    },

    computed:{

    }
}
</script>
