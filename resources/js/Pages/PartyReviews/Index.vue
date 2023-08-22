<template>
    <main class="subpage review review_party">
        <!-- banner  -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Review</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 후기</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 파티 후기</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //banner -->

        <div class="main-container">
            <div class="container">
                <div class="sub-top">
                    <h2 class="sub-title">
                        파티 후기
                    </h2>
                </div>
                <ul class="review-list col-group">
                    <li class="review-box" v-for="item in items.data" :key="item.id">
                        <a :href="`/partyReviews/${item.id}`">
                            <div class="bg-img">
                                <img :src="item.img ? item.img.url : ''" alt="">
                            </div>
                            <div class="txt-box">
                                <p class="title">
                                    {{ item.title }}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="m-empty type01" v-if="items.data.length === 0">데이터가 없습니다.</div>

                <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />

            </div>
        </div>

    </main>


</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            items: this.$page.props.items,
            form: this.$inertia.form({
                page: 1,
            }),
        }
    },
    methods: {
        filter(){
            this.form.get("/partyReviews", {
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
