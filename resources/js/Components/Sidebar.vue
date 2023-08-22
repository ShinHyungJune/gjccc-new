<template>
    <div class="left-wrap">
        <div class="user-profile">
            <div class="user-photo" :style="`background-image:url(${$page.props.user.data.img ? $page.props.user.data.img.url : ''}); background-repeat:no-repeat; background-size:100%; background-position:center;`"></div>
            <p class="user-name">
                {{ $page.props.user.name }}
            </p>
            <a href="/users/edit" class="edit-btn">프로필 수정</a>
        </div>
        <ul class="mypage-menu">
            <li :class="navClass('/datings')">
                <a href="/datings">소개팅 목록</a>
            </li>
            <li :class="navClass('/partyOrderProducts')">
                <a href="/partyOrderProducts">파티 목록</a>
            </li>
            <li :class="navClass('/orders')">
                <a href="/orders">결제내역</a>
            </li>
            <li :class="navClass('/users/remove')">
                <a href="/users/remove">회원 탈퇴</a>
            </li>
        </ul>
    </div>
</template>
<script>
    import {Link} from '@inertiajs/inertia-vue';
    export default {
        components: {Link},
        data(){
            return {
                active: false
            }
        },
        methods: {
            navClass(href){
                return href.includes(location.pathname) ? "active" : "";
            }
        }
    }
</script>
