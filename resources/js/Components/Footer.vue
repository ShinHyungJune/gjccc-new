<template>
    <div id="footer">

        <div class="footer-wrap">
            <a href="#" class="footer-logo">
                <img src="/images/footer-logo.png" style="width: 120px;" alt="logo">
            </a>
            <div class="col-group">
                <ul class="col-group">
                    <li><a href="/privacy01">개인정보처리방침</a></li>
                    <li><a href="/privacy02">이용약관 및 환불규정</a></li>
                    <li><a href="/story">회사소개</a></li>
                </ul>
            </div>
            <span>대표 : 이태현 &nbsp; 주소 : 서울특별시 강남구 영동대로 602, 6층 &nbsp;<br class="mb" />대표전화 : 1660-1369 &nbsp; 이메일 : cs@insacompany.com &nbsp;</span>
            <span>통신판매업 신고번호 : 제 2023-서울강남-00152호  &nbsp; 사업자명 : 만날사람들 &nbsp; <br class="mb" />사업자등록번호 : 481-17-02165</span>
            <span class="copyright">Copyright 만날사람들 All rights reserved.</span>
            <button id="upBtn" class="mb" >
                <i class="xi-long-arrow-up"></i>
            </button>
        </div>
    </div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
export default {
    components: {Link},
    data(){
        return {
            activeFamilyPop: false,
        }
    },
    mounted() {
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 200) {
                    $("#upBtn").fadeIn();
                } else {
                    $("#upBtn").fadeOut();
                }
            });
            $("#upBtn").click(function () {
                $("html, body").animate(
                    {
                        scrollTop: 0,
                    },
                    400
                );
                return false;
            });
        });
    }
}
</script>
