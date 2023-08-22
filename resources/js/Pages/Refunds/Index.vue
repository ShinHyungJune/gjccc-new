<template>
    <div class="mypage-wrap col-group">
        <sidebar />

        <div class="right-wrap">
            <div class="title-wrap col-group">
                <h2>환불내역</h2>
                <a href="/orders" class="refund-btn">결제내역</a>
            </div>

            <div class="con-wrap">
                <ul class="payment-list row-group">
                    <li v-for="refund in refunds.data" :key="refund.id" @click.prevent="targetRefund = refund" style="cursor:pointer;">
                        <div class="tr col-group">
                            <div class="title-box row-group">
                                <span class="label">{{ refund.order.product.type }}</span>
                                <p class="title">{{ refund.order.product.title }}</p>
                            </div>
                            <ul class="payment-box col-group">
                                <li>
                                    <p class="title">환불요청날짜</p>
                                    <p class="txt">{{ refund.created_at }}</p>
                                </li>
                                <li>
                                    <p class="title">환불요청사유</p>
                                    <p class="txt">{{ refund.reason_request }}</p>
                                </li>
                                <li>
                                    <p class="title">결제날짜</p>
                                    <p class="txt">{{ refund.order.created_at }}</p>
                                </li>
                                <li>
                                    <p class="title">결제금액</p>
                                    <p class="txt">{{ refund.order.price.toLocaleString() }}</p>
                                </li>
                                <li>
                                    <p class="title">상태</p>
                                    <p class="txt state">{{ state(refund.state) }}</p>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <div class="m-empty type01" v-if="refunds.data.length === 0">데이터가 없습니다.</div>

                <!-- 파티 환불요청서 모달 -->
                <div class="modal-overley refund open" v-if="targetRefund">
                    <div class="modal-wrap refund">
                        <button type="button" class="close" @click="targetRefund = ''">
                            <i class="xi-close"></i>
                        </button>

                        <div v-if="targetRefund.order.product.type === '파티'">
                            <div class="title-wrap" style="display:block;">
                                <i class="xi-lock"></i>
                                <h2 class="title">
                                    파티 환불신청서
                                </h2>
                                <p class="txt">
                                    참가비 환불 절차는 공정거래위원회의 소비자 환불규정에 따라 <br>
                                    아래와 같습니다. 참석 인원 미달되거나 주최측에 의한 <br>
                                    이벤트 취소의 경우, 전액 환불 도와드립니다.
                                </p>
                            </div>
                            <div class="request-wrap party-wrap">
                                <ul class="request-box request-box-2 row-group">
                                    <li class="col-group">
                                        <p class="default">결제금액</p>
                                        <div class="user col-group">
                                            <p class="nonedit">{{ targetRefund.price.toLocaleString() }}</p>원
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불사유</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" disabled :value="targetRefund.reason_request" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="notice-box">
                                <div class="title-box">
                                    <p class="title">
                                        <i class="xi-warning"></i>
                                        환불 규정
                                    </p>
                                    <p class="txt">
                                        참가비 환불 절차는 공정거래위원회의 소비자 환불규정에 따라 아래와 같습니다. <br>
                                        참석 인원 미달되거나 주최측에 의한 이벤트 취소의 경우, 전액 환불 도와드립니다.
                                    </p>
                                </div>
                                <div class="con-box">
                                    <p class="title">
                                        개인적인 사유로 취소 신청할 경우
                                    </p>
                                    <ul class="row-group">
                                        <li>파티일자 7일 이전: 입장료 전액 환불 (송금수수료 -1,000원 공제)</li>
                                        <li>파티일자 5일 이전: 입장료 70% 환불</li>
                                        <li>파티일자 4일 이전: 입장료 50% 환불</li>
                                        <li>파티일자 3일 이전: 입장료 30% 환불</li>
                                        <li>파티일자 2일 이내 또는 당일 불참: 환불 불가</li>
                                        <li>환불 소요일 : 영업일 기준으로 1~7일</li>
                                    </ul>
                                </div>
                                <div class="btm-box">
                                    <p class="title">카카오채널 추가 & 메시지 꼭 주세요!</p>
                                    <p class="txt">[파티신청날짜/이름/전화번호/동행인여부/동행인이름/결제여부]</p>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <div class="title-wrap">
                                <i class="xi-lock"></i>
                                <h2 class="title">
                                    소개팅 환불신청서
                                </h2>
                                <p class="txt">
                                    만날사람들(이하 '회사')이 제공하는 소개팅 서비스에 가입하기 위하여 계약 내용을 인지하고 이용금액을
                                    결제함으로써 해당 서비스의 가입 및 계약이 성립됩니다. 회사의 가입기준에 따라서 가입이 제한
                                    또는 거절될 수 있으며 그럴 경우에는 전액 환불 도와드리고 있습니다.
                                </p>
                            </div>
                            <div class="request-wrap">
                                <ul class="request-box request-box-2 row-group">
                                    <li class="col-group">
                                        <p class="default">결제금액</p>
                                        <div class="user col-group">
                                            <p class="nonedit">{{ targetRefund.price.toLocaleString() }}</p>원
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불사유</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" disabled :value="targetRefund.reason_request" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="notice-box">
                                <div class="title-box">
                                    <p class="title">
                                        <i class="xi-warning"></i>
                                        환불 규정
                                    </p>
                                    <p class="txt">
                                        만날사람들(이하 '회사')이 제공하는 소개팅 서비스에 가입하기 위하여 계약 내용을 인지하고 이용금액을
                                        결제함으로써 해당 서비스의 가입 및 계약이 성립됩니다. 회사의 가입기준에 따라서 가입이 제한
                                        또는 거절될 수 있으며 그럴 경우에는 전액 환불 도와드리고 있습니다.
                                    </p>
                                </div>
                                <div class="con-box">
                                    <ul class="row-group blind-num">
                                        <li>1.만날사람들 가격표는 VAT가 포함된 가격이며, 정찰제로 운영됩니다.</li>
                                        <li>2.프로그램은 연령대별로 가격이 상이합니다.</li>
                                        <li>3.서비스 이용료 납부와 동시에 상담, 회원 등록, 매칭 등 소개팅 프로세스가 진행되기 때
                                            문에 결제금액에서 이용금액과 위약금 20%를 제하고 환불 가능합니다.</li>
                                        <li>4.첫 프로필 제공은 최소 2주가 소요됩니다.</li>
                                        <li>5.첫 프로필 제공 후에 환불 요청 시에는 1회 차감 후 환불됩니다.</li>
                                        <li>6.환불 가능 기간은 프로그램 기간동안이며, 환불액 산정은 남은 횟수/가입 횟수에 따라 산
                                            정됩니다. (즉, 추가 서비스 횟수가 제공된 경우, 환불 시에 추가 서비스 횟수를 제외하고
                                            산정됩니다.)</li>
                                        <li>7.프로필 수령 후 24시간 내에 소개팅 날짜, 장소를 조율해주세요. 24시간 내에 무응답일
                                            경우, 프로그램 진행 회피로 여겨 횟수 차감이나 불이익이 발생합니다</li>
                                        <li>8.소개팅 확정 후에 취소나 변경 시에는 횟수 차감뿐만 아니라 프로그램 이용이 거절될 수
                                            있습니다</li>
                                        <li>9.회원권 이용기간은 프로그램 기간과 동일하며, 개인적인 사유(해외파견, 출장, 입원 등)로
                                            추가 연장을 요구하는 경우는 최대 프로그램 기간만큼 유효하며 서류 증빙 후 가능합니
                                            다. (단, 기간 연장의 경우 환불은 불가합니다.)</li>
                                        <li>10.만날사람들을 통해 교제하거나 성혼하게 된 경우, 이용 목적이 달성되는 것으로 프로그램 종료
                                            이나 횟수가 남아 있으실 경우에는 가입하신 프로그램 기간만큼 연장 가능합니다</li>
                                        <li>11.회원 교제나 성혼의 이유로 이용이 불가할 때, 지인(신규회원)에게 양도 가능합니다.</li>
                                        <li>12.회원이 제출한 개인정보를 사실로 간주하며 허위로 의심되는 경우 진위 여부를 확인하기
                                            위하여 당사자에게 정보에 관하여 증명을 요구할 수 있으며 허위의 사실을 제출한 경우
                                            서비스의 이용을 제한하거나 거부할 수 있으며 손해배상을 청구할 수 있으며, 회사의 과
                                            실과 책임은 없습니다.</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <button type="button" class="submit-btn" @click="check">환불 확인</button>
                    </div>
                </div>

<!--                <a href="http://pf.kakao.com/_kvwsxj" class="kakao-btn">
                    <img class="kakao-cir" src="/images/kakao-circle.png" alt="kakao-circle">
                </a>-->
            </div>
        </div>
    </div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";
import Sidebar from "../../Components/Sidebar";

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {
            refunds: this.$page.props.refunds,

            form: this.$inertia.form({
                page: 1,
            }),
            targetRefund: "",
        }
    },
    methods:{
        filter(){

        },

        check(){
            this.form.patch("/refunds/" + this.targetRefund.id + "/check", {
                preserveScroll:true,
                preserveState: true,
                onSuccess: (page) => {
                    this.refunds = page.props.refunds;

                    this.targetRefund = "";
                }
            });
        },

        productTotalPrice(product){
            let total = 0;
            let optionPrice = 0;

            product.discounted_price;

            product.optionProducts.map(optionProduct => optionPrice += optionProduct.price * optionProduct.count);

            total = (product.discounted_price + optionPrice) * product.count;

            return total;
        },

        state(state){
            if(state === "승인대기")
                return "환불신청";

            return state;
        }
    }
}
</script>
