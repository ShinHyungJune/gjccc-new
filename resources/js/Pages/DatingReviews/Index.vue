<template>

    <main class="subpage review review_date">
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
                        <li><a href="#"> 소개팅 후기</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //banner -->

        <div class="main-container">
            <div class="container">
                <div class="sub-top">
                    <h2 class="sub-title">
                        소개팅 후기
                    </h2>
                </div>

                <ul class="review-list col-group">
                    <dating-review :item="item" v-for="item in items.data" :key="item.id" />
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
import DatingReview from "../../Components/DatingReview";

export default {
    components: {DatingReview, Link, Pagination},
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
            this.form.get("/datingReviews", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.items = page.props.items;
                }
            });
        },


    },
    computed: {

    }
}
</script>
