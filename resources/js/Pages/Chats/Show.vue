<template>
    <div id="wrap" class="popup-form chat-form">
        <div class="popup-header">
            <p>{{ partner(chat.dating).displayName }}</p>
            <i class="xi-close" @click="back"></i>
        </div>
        <!-- //header -->
        <div class="chat-area">
            <ul class="message-group" ref="container">
                <li class="new-message send" v-if="message.user.id == user.id" v-for="message in messages.data" :key="message.id">
                    <p class="new-message-time">{{ message.created_at }}</p>
                    <div class="new-message-txt">
                        <p style="white-space: pre-line" v-text="message.body"></p>
                    </div>
                </li>
                <li class="new-message receive" v-else>
                    <div class="new-message-txt">
                        <p style="white-space: pre-line" v-text="message.body"></p>
                    </div>
                    <p class="new-message-time">{{message.created_at}}</p>
                </li>
            </ul>
        </div>

        <form action="" @submit.prevent="store">
            <div class="chat-footer">
                 <textarea name="" id="" placeholder="개인정보 보호를 위해 연락처 교환은 제한하며,
적발시 서비스 이용이 제한될 수 있습니다." v-model="form.body"></textarea>
                <div class="chat-btn-wrap">
                    <button type="submit" class="chat-send">
                        <i class="xi-send"></i>
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</template>
<style>
    .nprogress-busy #nprogress {display:none;}
</style>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            user: this.$page.props.user.data,
            chat: this.$page.props.chat.data,
            messages: this.$page.props.messages,
            form: this.$inertia.form({
                page:1,
                chat_id: this.$page.props.chat.data.id,
                body: "",
                word: "",
            }),
        }
    },

    methods:{
        store(){
            if(this.form.body !== "")
                this.form.post("/messages", {
                    preserveScroll: true,
                    preserveState: true,
                    replace:true,
                    progressIndicator: false,
                    onSuccess: (page) => {
                        this.form.body = "";
                    }
                });
        },

        filter(){

        },

        // 채널 연결(메시지 생성 시 웹소켓으로 받아내기)
        setChannel() {
            if(Object.keys(window.Echo.connector.channels).length === 0 || !window.Echo.connector.channels[`private-chats.${this.chat.id}`]){ // 채널 중복 접속 방지

                window.Echo.private(`chats.${this.chat.id}`)
                    .listen("MessageCreated", (e) => {
                        e.message.user = this.chat.users.find(user => user.id == e.message.user_id);

                        this.messages.data.push(e.message);

                        if(e.message.user && e.message.user_id == this.user.id)
                            this.initScroll();
                    });
            }

        },

        initScroll(){
            let self = this;

            setTimeout(function () {
                self.$refs.container.scrollTop = self.$refs.container.scrollHeight;
            }, 500);
        },

        leave(){
            this.form.delete("/chats/" + this.chat.id, {
                replace:true,
                onSuccess: (page) => {
                    window.Echo.leave(`chats.${this.chat.id}`);
                }
            })
        },

        back(){
            window.location.href="/datings";
        },

        partner(dating){
            if(this.user.sex === "남자")
                return dating.women;

            return dating.men;
        },

        loadMore(state){
            if(this.form.page < this.messages.meta.last_page){
                this.form.page += 1;

                this.form.get("/chats/" + this.chat.id, {
                    preserveScroll: true,
                    preserveState: true,
                    replace: true,

                    onSuccess: (page) => {
                        state.loaded();

                        this.messages = {
                            ...page.props.messages,
                            data: [...this.messages.data, ...page.props.messages.data]
                        }

                        // 이게 없으면 url에 page=2, page=3 이런식으로 붙고 그 상태에서 새로고침 시 3페이지부터 보임
                        window.history.replaceState(null, null, window.location.pathname);
                    }
                })
            }

        },
    },


    mounted() {
        this.setChannel();

        this.initScroll();
    }
}
</script>
