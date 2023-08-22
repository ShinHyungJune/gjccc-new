<template>
    <main class="subpage mypage">
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
                        <li><a href="#"> 파티목록</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mypage-wrap col-group">
            <sidebar />

            <div class="right-wrap">
<!--                <a href="http://pf.kakao.com/_kvwsxj" class="kakao-btn"><img src="/images/kakao-circle.png" alt="kakao-circle" class="kakao-cir"></a>-->

                <div class="title-wrap col-group">
                    <h2>파티 목록</h2>
                    <ul class="tab-link col-group">
                        <li :class="form.state === '예약중' ? 'active' : ''" @click="() => {form.state = '예약중'; filter();}">예약중</li>
                        <li :class="form.state === '마감' ? 'active' : ''" @click="() => {form.state = '마감'; filter();}">마감</li>
                    </ul>
                </div>

                <div class="tab-content active">
                    <ul class="party-list col-group">
                        <li class="party-box" v-for="item in items.data" :key="item.id">
                            <a :href="`/partyProducts/${item.product.id}`">
                                <div class="img-box">
                                    <img :src="item.product.img ? item.product.img.url : ''" alt="">
                                </div>
                                <span :class="`state-label ${item.product.ongoing ? 'ongoing' : ''}`">
                                    <!-- 예약중일 시 ongoing 클래스 추가 -->
                                    {{ item.product.ongoing ? '예약중' : '마감' }}</span>
                                <div class="txt-wrap">
                                    <div class="txt-box row-group">
                                        <p class="date">
                                            {{ item.product.opened_at }}
                                        </p>
                                        <p class="title">
                                            {{ item.product.title }}
                                        </p>
                                        <ul class="tag-list col-group">
                                            <li class="tag" v-for="tag in item.product.tags">{{ tag }}</li>
                                        </ul>
                                    </div>
                                    <div class="attend-list col-group">
                                        <div class="attend attend_w">
                                            <img src="/images/party-icon-w.svg" alt="">
                                            <p class="col-group state-num">
                                                <span class="user">{{item.product.accept_women}}</span>/<span class="default">{{item.product.max_women}}</span>
                                            </p>
                                        </div>
                                        <div class="attend attend_m">
                                            <img src="/images/party-icon-m.svg" alt="">
                                            <p class="col-group state-num">
                                                <span class="user">{{item.product.accept_men}}</span>/<span class="default">{{item.product.max_men}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <button type="button" :class="`party-btn ${item.accept ? 'active' : ''}`">파티 참석권</button><!-- 파티 참석권 활성 화 시 active 클래스 추가 -->
                        </li>
                    </ul>

                    <div class="m-empty type01" v-if="items.data.length === 0">
                        데이터가 없습니다.
                    </div>
                </div>
            </div>
        </div>
    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import Sidebar from "../../Components/Sidebar";

export default {
    components: {Sidebar, Link, Pagination},
    data() {
        return {
            items: this.$page.props.items,
            form: this.$inertia.form({
                page: 1,
                state: this.$page.props.state,
            }),
        }
    },
    methods: {


        filter() {
            this.form.get("/partyOrderProducts", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.items = page.props.items;
                }
            });
        }
    },
    computed: {

    }
}
</script>
