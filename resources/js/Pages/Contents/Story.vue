<template>
    <main class="subpage story">
        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Story</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 만날사람들</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 탄생배경</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- story -->
        <div class="subpage-info">
            <div class="container sub">
                <div class="test-section">
                    <div class="img-box">
                        <img class="story" src="/images/dear-img.jpg" alt="story">
                    </div>
                    <div class="story-contents">
                        <div class="story-top">
                            <p class="story-title">Dear</p>
                            <div class="story-line"></div>
                        </div>
                        <p class="story-explanation">
                            안녕하세요. 만날사람들 대표 이태현입니다.^^<br />
                            만날사람들이라는 회사를 만나기까지 우여곡절 많으셨죠?<br />
                            <br />
                            저는 다년간 사랑이라는 분야에서 일했습니다.<br />
                            인생의 한 번뿐인 가장 설레는<br class="br-mb3"/> 결혼 준비를 돕기도 했고,<br />
                            인생의 하나뿐인 짝을 만나도록  <br class="br-mb2"/>소개팅 주선을 하기도 했습니다.<br />
                            또한, 자연스러운 네트워킹 파티를 <br class="br-mb3"/>  운영하기도 했죠.<br />
                            <br />
                            인생에 있어서 <br class="br-mb3"/> 좋은 조건을 갖추는 것만큼  <br class="br-mb2 n"/>중요한 것은<br class="br-mb1 n"/><br class="br-mb3"/>
                            <b>바로 나의 인연을 만나는 일입니다.</b><br />
                            <br class="br-mb3"/>

                            저는 '좋은 인연을 만나려면 어떻게 하지?' <br class="br-mb1"/>진지하게 고민하고 노력했습니다.<br />
                            결혼정보회사, 소개팅 앱, 파티,<br class="br-mb2 n"/> 모임, 지인 소개팅 등  <br class="br-mb3"/> 안 해본 게 없습니다.<br />
                            여러분도 그렇지 않으신가요?<br />
                            <br />
                            결혼정보회사, 소개팅 앱 모두 <br class="br-mb3"/>이루려는 목표가 같을 겁니다.<br />
                            하지만 모든 분들이 원하는 <br class="br-mb2"/> 커플, 결혼에 도달하기에는 어려운 구조입니다.<br />
                            그래서 만날사람들이 필요하다고 생각했어요.<br />
                            <br />
                            저는 디지털이 유일하게 할 수 없는 것이 <br class="br-mb2"/> 인간관계라고 생각합니다.<br />
                            그렇기때문에 소개팅에 있어서 <b>주선자와의 관계는 <br class="br-mb2"/> 기본이며 중요하다고 생각해요.</b><br />
                            대개 나를 가장 잘 알고 친한 친구가 <br class="br-mb2"/> 나의 인연을 이어주는 매개체 역할을 하니까요.<br />
                            <b>만날사람들이 가장 친한 친구가 되겠습니다.</b><br />
                            <br />
                            진정성 있는 시작이  <br class="br-mb3"/>나의 인연을 찾는 열쇠입니다.<br />
                            제가 여러분의 가장 친한 친구가 되어  <br class="br-mb3"/>노력하겠습니다.<br />
                            나에게 맞는 단 한 사람, <br class="br-mb3"/>만날사람들과 함께 찾아보아요!<br />
                        </p>
                    </div>
                </div>
            </div>
            <div class="subpage-under">
                <span class="subpage-under-text">The most important thing in life is love</span>
            </div>
        </div>
    </main>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {

        }
    },

    methods:{

    },


    mounted() {

    }
}
</script>
