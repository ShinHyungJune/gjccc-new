<template>
    <main class="subpage post">
        <div class="container">
            <div class="post-header">
                <p class="post-header-title">{{ item.title }}</p>
                <p class="post-header-date">{{ item.created_at }}</p>
            </div>
            <div class="post-main">
                <div class="editor-wrap" v-html="item.description"></div>
            </div>
            <div class="post_navigaiton">
                <div class="post-pre-btn">
                    <a :href="`/partyNotices/${item.prev.id}`" v-if="item.prev">
                        <i class="xi-long-arrow-left"></i>
                        <span> 이전글</span>
                    </a>
                </div>
                <a href="/partyNotices"><button class="post-list-btn">목록</button></a>
                <div class="post-next-btn">
                    <a :href="`/partyNotices/${item.next.id}`" v-if="item.next">
                        <span> 다음글</span>
                        <i class="xi-long-arrow-right"></i>
                    </a>
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
            item: this.$page.props.item.data,

        }
    },
    methods: {

    },
    computed: {

    }
}
</script>
