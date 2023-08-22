<template>
    <main class="subpage notice coment">

        <!-- banner  -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Notice</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 게시판</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#">소개팅관련</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //banner -->
        <div class="News">
            <div class="sub-con">
                <div class="container">
                    <div class="list-top">
                        <p class="list-title">소개팅관련</p>
                        <form action="" @submit.prevent="filter">
                            <div class="search-wrap"><input type="text" id="search" placeholder="검색어를 입력하세요" v-model="form.word"><button @click="filter"><i class="xi-search"></i></button></div>
                        </form>
                    </div>
                    <ul class="coment-list">
                        <li v-for="(item, index) in items.data">
                            <a :class="item.important ? 'fix-list' : ''" :key="item.id" @click="$inertia.get(`/datingNotices/${item.id}`)">
                                <div class="date">
                                    <span class="sticker pc" v-if="item.important">공지</span>
                                    <span :class="item.important ? 'fix-day' : 'day'">{{ ((items.meta.current_page - 1) * items.meta.per_page) + (index + 1) }}</span>
                                    <span class="year">{{ item.year }}.{{ item.month }}</span>
                                </div>
                                <div class="title-wrap notify">
                                    <div class="txt-wrap">
                                        <div>
                                            <p class="title">{{ item.title }}</p>
                                        </div>
                                        <p class="con">
                                            {{item.description.replace(/<\/?[^>]+>/ig, " ")}}
                                        </p>
                                    </div>
                                </div>
                                <div class="detail-btn">
                                    <i class="xi-plus"></i>
                                </div>
                            </a>

                        </li>
                    </ul>

                    <div class="m-empty type01" v-if="items.data.length === 0">
                        데이터가 없습니다.
                    </div>

                    <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />

                </div>
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
                word: "",
                page: 1,
            }),
        }
    },
    methods: {
        filter(){
            this.form.get("/datingNotices", {
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
