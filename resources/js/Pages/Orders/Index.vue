<template>
    <main class="subpage mypage mypage_payment">
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
                        <li><a href="#"> 결제내역</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mypage-wrap col-group">
            <sidebar />

            <div class="right-wrap">
                <div class="title-wrap col-group">
                    <h2>결제내역</h2>
                    <a href="/refunds" class="refund-btn">환불내역</a>
                </div>

                <ul class="top-wrap col-group">
                    <li>
                        <p class="title">
                            사용 이용권
                        </p>
                        <div class="txt-box col-group">
                            <img src="/images/payment-icon-01.png" alt="">
                            <p class="txt">
                                {{ user.count_matching_dating }}건
                            </p>
                        </div>
                    </li>
                    <li>
                        <p class="title">
                            남은 이용권
                        </p>
                        <div class="txt-box col-group">
                            <img src="/images/payment-icon-02.png" alt="">
                            <p class="txt">
                                {{ user.count_dating }}건
                            </p>
                        </div>
                    </li>
                    <li>
                        <p class="title">
                            예약된 파티
                        </p>
                        <div class="txt-box col-group">
                            <img src="/images/payment-icon-03.png" alt="">
                            <p class="txt">{{ user.count_party }}건</p>
                        </div>
                    </li>
                    <li>
                        <p class="title">
                            마감된 파티
                        </p>
                        <div class="txt-box col-group">
                            <img src="/images/payment-icon-04.png" alt="">
                            <p class="txt">{{ user.count_close_party }}건</p>
                        </div>
                    </li>
                </ul>
                <div class="con-wrap">
                    <div class="search-wrap col-group">
                        <h3 class="title">결제 내역 조회</h3>
                        <form action="" @submit.prevent="filter">
                            <div class="search-box col-group">
                                <input type="date" v-model="form.started_at">
                                <span>-</span>
                                <input type="date" v-model="form.finished_at">
                                <select name="" id="" v-model="form.type">
                                    <option value="">전체</option>
                                    <option value="파티">파티</option>
                                    <option value="소개팅">소개팅</option>
                                </select>
                                <button type="submit" class="search-btn">조회</button>
                            </div>
                        </form>
                    </div>
                    <ul class="payment-list row-group">
                        <li class="date" v-for="order in orders.data" :key="order.id" v-if="order.product">
                            <div class="tr col-group">
                                <div class="title-box row-group">
                                    <span class="label">{{ order.product.type }}</span>
                                    <p class="title">{{ order.product.title }}</p>
                                </div>
                                <ul class="payment-box col-group">
                                    <li>
                                        <p class="title">결제수단</p>
                                        <p class="txt">{{order.pay_method_name}}</p>
                                    </li>
                                    <li v-if="order.product.type === '파티'">
                                        <p class="title">파티일자</p>
                                        <p class="txt">{{order.product.opened_at}}</p>
                                    </li>
                                    <li v-if="order.product.type === '소개팅'">
                                        <p class="title">충전횟수</p>
                                        <p class="txt">{{order.product.count_dating}}</p>
                                    </li>
                                    <li>
                                        <p class="title">결제금액</p>
                                        <p class="txt">{{order.price.toLocaleString()}}</p>
                                    </li>
                                    <li>
                                        <p class="title">결제날짜</p>
                                        <p class="txt">{{order.created_at}}</p>
                                    </li>

<!--                                    <li class="btn-wrap" v-if="order.can_refund">
                                        <button class="m-btn type01" @click="targetRefundOrder = order">환불요청</button>
                                    </li>-->
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="m-empty type01" v-if="orders.data.length === 0">
                        데이터가 없습니다.
                    </div>
                </div>

<!--                <a href="http://pf.kakao.com/_kvwsxj" class="kakao-btn">
                    <img class="kakao-cir" src="/images/kakao-circle.png" alt="kakao-circle">
                </a>-->
            </div>
        </div>
    </main>
</template>
<script>
import Sidebar from "../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";

export default {
    components: {State, Sidebar, Link, Pagination},
    data() {
        return {
            user: this.$page.props.user.data,
            orders: this.$page.props.orders,
            form: this.$inertia.form({
                page: 1,
                started_at : this.$page.props.started_at,
                finished_at : this.$page.props.finished_at,
                type : this.$page.props.type,
            }),
            refundForm: this.$inertia.form({
                order_id: "",
                reason_request: "",
                bank:"",
                account: "",
                owner:"",
            }),
            targetRefundOrder: ""
        }
    },
    methods: {
        filter() {
            this.form.get("/orders", {
                preserveScroll:true,
                preserveState: true,
                onSuccess: (page) => {
                    this.orders = page.props.orders;
                }
            });
        },
        refund(){
            this.refundForm.order_id = this.targetRefundOrder.id;

            this.refundForm.post("/refunds", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.targetRefundOrder = "";
                    this.orders = page.props.orders;
                }
            })
        }
    }
}
</script>
