<template>
    <li class="review-box">
        <div class="m-pop type01" v-if="active">
            <div class="m-pop-inner">
                <button class="btn-close" @click="active = false;">
                    <i class="xi-close"></i>
                </button>
                <img :src="item.img ? item.img.url : ''" alt="">
            </div>
        </div>

        <a href="#" @click.prevent="move(item)">
            <div :class="`bg-img ${!item.description ? 'no-blind' : ''}`">
                <img :src="item.img ? item.img.url : ''" alt="">
            </div>
            <span class="sns-badge" v-if="item.platform === 'INSTAGRAM'"><img src="/images/sns-icon-insta.png" alt=""></span>
            <span class="sns-badge" v-if="item.platform === 'NAVER'"><img src="/images/sns-icon-blog.png" alt=""></span>
            <div class="txt-box">
                <ul class="user-info col-group" v-if="item.sex || item.age || item.job">
                    <li v-if="item.sex">{{item.sex}}</li>
                    <li v-if="item.age">{{item.age}}</li>
                    <li v-if="item.job">{{item.job}}</li>
                </ul>
                <p class="title">
                    {{item.title}}
                </p>
                <p class="txt" v-if="item.description">
                    {{item.description.replace(/<\/?[^>]+>/ig, " ")}}
                </p>
            </div>
        </a>
    </li>
</template>
<script>
export default {
    props: ["item"],
    data(){
        return {
            active: false,
        }
    },
    methods: {
        move(item){
            if(item.url)
                return window.open(item.url, "pop", "_blank");

            return this.active = true;
        }
    }
}
</script>
