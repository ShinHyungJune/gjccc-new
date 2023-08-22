<template>
    <section class="mypage-state" id="mypage_state">
        <ul class="col-group" v-if="user">
            <li class="col-group">
                <div class="left-box">
                    <div class="img-box">
                        <img src="/images/icon_reserves.svg" alt="">
                    </div>
                    <p>
                        보유 적립금
                    </p>
                </div>
                <div class="right-box">
                    <a href="#" class="num">
                <span>
                    {{ user.point.toLocaleString() }}
                </span>
                    </a>
                    <a href="#" @click.prevent="active = true">
                        적립 기준 보기
                        <i class="xi-angle-right"></i>
                    </a>
                </div>
            </li>
            <!--        <li class="col-group">
                        <div class="left-box">
                            <div class="img-box">
                                <img src="/images/icon_coupon.svg" alt="">
                            </div>
                            <p>
                                쿠폰
                            </p>
                        </div>
                        <div class="right-box">
                            <a href="/mudmat_test/mall/mypage_coupon.html" class="num">
                            <span>
                                0
                            </span>
                            </a>
                        </div>
                    </li>-->
            <li class="col-group">
                <div class="left-box">
                    <div class="img-box">
                        <img src="/images/icon_cart_.png" alt="">
                    </div>
                    <p>
                        장바구니
                    </p>
                </div>
                <div class="right-box">
                    <a href="/shopping/carts" class="num">
                <span>
                    {{ user.count_cart }}
                </span>
                    </a>
                </div>
            </li>
            <li class="col-group">
                <div class="left-box">
                    <div class="img-box">
                        <img src="/images/icon_review.svg" alt="">
                    </div>
                    <p>
                        리뷰
                    </p>
                </div>
                <div class="right-box">
                    <a href="/shopping/reviews" class="num">
                <span>
                    {{ user.count_review }}
                </span>
                    </a>
                </div>
            </li>
        </ul>

        <div class="m-pop type01" style="display:block;" v-if="active">
            <div class="m-pop-header">
                <h3 class="m-pop-header-title">적립금 기준</h3>

                <i class="xi-close m-pop-btn-close" @click="active = false;"></i>
           </div>

            <div class="m-pop-content">
                <pre style="white-space: pre-line" v-html="basic ? basic.point_policy : ''"></pre>
            </div>
        </div>
    </section>
</template>
<script>
    import {Link} from '@inertiajs/inertia-vue';
    export default {
        components: {Link},
        data(){
            return {
                user: this.$page.props.user ? this.$page.props.user.data : "",
                basic: this.$page.props.basic ? this.$page.props.basic.data : "",
                active: false,
            }
        },
        methods: {

        }
    }
</script>
