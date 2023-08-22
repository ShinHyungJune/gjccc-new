<template>
    <main class="subpage application">
        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Service</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">서비스</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">파티신청</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- service-party -->
        <div class="application-container-party">
            <div class="application-contents">
                <img src="/images/crown5.png" alt="crown5">
                <p><span class="text-style-1">검증된</span><br/>
                    다대다<br class="mb"/> 파티 서비스
                </p>
            </div>
            <div class="sub-container-contents">
                <ul class="application-service-offer">
                    <li><img src="/images/party-num-01.png" alt="party-num-01"></li>
                    <li><img src="/images/party-num-02.png" alt="party-num-02"></li>
                    <li><img src="/images/party-num-03.png" alt="party-num-03"></li>
                    <li><img src="/images/party-num-04.png" alt="party-num-04"></li>
                    <li><img src="/images/party-num-05.png" alt="party-num-05"></li>
                </ul>
            </div>
        </div>
        <div class="sub-container">
            <div class="sub-container-contents">
                <p class="title">Party</p>
                <img class="sub-line-short" src="/images/line-short.png" alt="line">
                <p>
                    파티를 통한 자연스러운 대화속에서 <br class="mb"/><span class="text-style-1">인연 혹은 친구</span>를 찾아보세요.<br/>
                    파티 서비스 지금 함께 참석해봐요.
                </p>
            </div>
        </div>
        <div class="application-container-party">
            <ul class="application-states tab-link">
                <li :class="`state ${form.state === '예약중' ? 'active' : ''}`" data-tab="tab_2" @click="() => {form.state='예약중'; filter();}">예약중</li>
                <li :class="`state ${form.state === '마감' ? 'active' : ''}`" data-tab="tab_3" @click="() => {form.state='마감'; filter();}">마감</li>
            </ul>
            <div class="tab-content active">
                <ul class="party-list col-group">
                    <li class="party-box" v-for="product in products.data" :key="product.id">
                        <a :href="`/partyProducts/${product.id}`">
                            <div class="img-box">
                                <img :src="product.img ? product.img.url : ''" alt="party-thum">
                            </div>
                            <span :class="`state-label ${product.ongoing ? 'ongoing' : 'close'}`">{{product.ongoing ? '예약중' : '마감'}}</span>
                            <div class="txt-wrap">
                                <div class="txt-box row-group">
                                    <p class="date">
                                        {{ product.opened_at }}
                                    </p>
                                    <p class="title">
                                        {{ product.title }}
                                    </p>
                                    <ul class="tag-list col-group">
                                        <li class="tag" v-for="(tag, index) in product.tags" :key="index">{{ tag }}</li>
                                    </ul>
                                </div>
                                <div class="attend-list col-group">
                                    <div class="attend attend_w">
                                        <img src="/images/party-icon-w.png" alt="">
                                        <p class="col-group state-num">
                                            <span class="user">{{ product.accept_women }}</span>/<span class="default">{{ product.max_women }}</span>
                                        </p>
                                    </div>
                                    <div class="attend attend_m">
                                        <img src="/images/party-icon-m.png" alt="">
                                        <p class="col-group state-num">
                                            <span class="user">{{ product.accept_men }}</span>/<span class="default">{{ product.max_men }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
<!--                <a class="list-addview">
                    <button><i class="xi-angle-down-min"></i></button>
                </a>-->
            </div>

        </div>

        <div class="m-empty type01" v-if="products.data.length === 0">
            데이터가 없습니다.
        </div>

        <pagination :meta="products.meta" @paginate="(page) => {form.page = page; filter()}" />

    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            products: this.$page.props.products,
            form: this.$inertia.form({
                page: 1,
                state: this.$page.props.state,
            }),
        }
    },
    methods: {


        filter() {
            this.form.get("/partyProducts", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.products = page.props.products;
                }
            });
        }
    },
    computed: {

    }
}
</script>
