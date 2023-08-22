<template>
    <main class="subpage blind-date">
        <!-- banner  -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Service</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 서비스</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 소개팅 신청</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sub-container-blind">
            <div class="sub-container-contents">
                <div class="crown-wrap">
                    <img src="/images/sub02-line2.png" class="crown2" alt="">
                </div>
                <p class="title">올인원 1:1 프라이빗</p>
                <p class="sub-title">소개팅 서비스</p>
                <div class="line-wrap">
                    <img src="/images/line.png" class="sub-line mb line">
                </div>
                <p>
                    가장 친한 친구가 나에 대해서 잘 알듯,<br />
                    가장 친한 친구가 되어 <br class="mb" />모든 과정(상담-매칭-소개팅-후관리-컨설팅)을<br />
                    소통하는 '나’ 만을 위한 프라이빗한 소개팅 서비스입니다.<br />
                    아래의 가격 확인 버튼을 클릭하시면<br class="mb" /> 구체적인 금액 확인이 가능합니다.
                </p>
                <button class="sub-btn price-check" @click="active = true;">소개팅 가격 확인</button>
            </div>
            <div :class="`modal-overley request ${active ? 'open' : ''}`" v-if="active">
                <!-- 소개팅 신청 -->
                <div class="modal-wrap request">
                    <button type="button" class="close" @click="active = false">
                        <i class="xi-close"></i>
                    </button>
                    <div class="title-wrap only">
                        <img src="images/crown2.png" alt="">
                        <h2 class="title">
                            소개팅 신청
                        </h2>
                        <!-- <p class="txt"></p> -->
                    </div>
                    <form action="">
                        <div class="form-wrap">
                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <p class="default">프로그램</p>
                                    <div class="user">
                                        <select v-model="form.product_id" @change="form.option_id = ''">
                                            <option value="" disabled>선택</option>
                                            <option :value="product.id" v-for="product in products.data" :key="product.id">{{ product.title }}</option>
                                        </select>
                                    </div>
                                </li>

                                <li class="col-group">
                                    <p class="default">나이</p>
                                    <div class="user">
                                        <select v-model="form.option_id">
                                            <option value="" disabled>선택</option>
                                            <option v-for="option in selectedProduct.options" :value="option.id" :key="option.id" v-if="selectedProduct">{{ option.title }}</option>
                                        </select>
                                    </div>
                                </li>

                                <li class="col-group">
                                    <p class="default">결제수단</p>
                                    <div class="user">
                                        <select v-model="form.pay_method_id">
                                            <option value="" disabled>선택</option>
                                            <option v-for="payMethod in payMethods.data" :value="payMethod.id" :key="payMethod.id">{{ payMethod.name }}</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <p class="default">결제금액</p>
                                    <div class="user col-group nonedit">
                                        <p class="price">
                                            {{ totalPrice.toLocaleString() }} <span>원</span>
                                        </p>
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
                        <div class="agree-wrap form-box">
                            <div class="title-wrap col-group">
                                <p class="title">약관동의</p>
                                <label for="" @click="() => {agree1=true; agree2 = true;}">
                                    <input type="checkbox" id="" name="chk" checked v-if="agree1 && agree2">
                                    <input type="checkbox" id="" name="chk" v-else>
                                    <span class="radio-icon"></span>
                                    전체동의
                                </label>
                            </div>
                            <ul class="row-group agree-box">
                                <li>
                                    <label for="chk_1">
                                        <input type="checkbox" id="chk_1" name="chk" v-model="agree1">
                                        <span class="radio-icon"></span>
                                        환불규정을 모두 확인했으며 이에 동의 합니다
                                        <a href="/privacy02" target="_blank">
                                            <i class="xi-angle-right"></i>
                                        </a>
                                    </label>
                                </li>
                                <li>
                                    <label for="chk_2">
                                        <input type="checkbox" id="chk_2" name="chk" v-model="agree2">
                                        <span class="radio-icon"></span>
                                        개인정보 수집 및 이용에 대한 동의 (필수)
                                        <a href="/privacy01" target="_blank">
                                            <i class="xi-angle-right"></i>
                                        </a>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <button type="button" class="submit-btn" @click="order">결제하기</button>
                </div>
                <!-- //소개팅 신청 -->

            </div>
        </div>

        <div class="main-container">
            <div class="container">
                <div class="start-contents">
                    <p>
                        직장인이 되고<br />
                        언제, 어디서, 어떻게<br />
                        내 인연을 찾지?
                    </p>
                    <p>
                        만날 시간과 여유가 없는데…
                    </p>
                </div>
                <div class="service-contents">
                    <div class="crown-wrap type1 order">
                        <img src="/images/crown3@2x.png" class="crown3">
                    </div>
                    <p class="title order">만날사람들 소개팅</p>
                    <p class="sub-title">서비스 절차</p>
                    <div class="line-wrap type1">
                        <img src="/images/line-short.png" class="line-short">
                    </div>
                    <div class="service-step">
                        <div class="step-box">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-01@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p class="recolor">STEP 01</p>
                                <p>사전 상담</p>
                            </div>
                        </div>
                        <div class="step-box">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-02@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p>STEP 02</p>
                                <p>프로필 작성</p>
                            </div>
                        </div>
                        <div class="step-box">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-03@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p>STEP 03</p>
                                <p>소개팅 매칭</p>
                            </div>
                        </div>
                        <div class="step-box">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-04@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p>STEP 04</p>
                                <p>프로필 교환</p>
                            </div>
                        </div>
                        <!-- 여기부터 둘째줄 -->
                        <div class="step-box box-right">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-05@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p>STEP 05</p>
                                <p>일정 조율</p>
                            </div>
                        </div>
                        <div class="step-box box-right">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-06@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p class="recolor">STEP 06</p>
                                <p>소개팅</p>
                            </div>
                        </div>
                        <div class="step-box box-right step-box7">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-07@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p>STEP 07</p>
                                <p>피드백</p>
                            </div>
                        </div>
                        <div class="step-box box-right step-box7 step-box8">
                            <div class="step-wrap">
                                <img class="step-img" src="/images/service-icon-08@2x.png" alt="">
                            </div>
                            <div class="squair">
                                <p>STEP 08</p>
                                <p>컨설팅</p>
                            </div>
                            </span>
                        </div>


                    </div>
                    <!-- 박스끝 -->
                    <!-- step-1 -->
                    <div class="step-1 step-box">
                        <div class="crown-wrap type2">
                            <img src="/images/crown4@2x.png" class="crown2" alt="">
                        </div>
                        <p class="title-num">1</p>
                        <p class="title">상담</p>
                        <p class="sub-title">좋은 인연을 찾기 위한 <br  class="br-m"/>디테일한 1, 2차 상담을 진행합니다.</p>
                        <ul class="step-1-consult pc">
                            <li class="step-1-img-wrap">
                                <img src="/images/consult-01@2x.png" class="consult consult-01">
                            </li>
                            <li class="step-1-img-wrap">
                                <img src="/images/consult-02@2x.png" class="consult consult-01">
                            </li>
                            <li class="step-1-img-wrap">
                                <img src="/images/consult-03@2x.png" class="consult consult-01">
                            </li>
                        </ul>
                        <ul class="step-1-consult mb">
                            <li class="step-1-img-wrap">
                                <img src="/images/consult-mb-01.png" class="consult consult-01">
                            </li>
                            <li class="step-1-img-wrap">
                                <img src="/images/consult-mb-02.png" class="consult consult-02">
                            </li>
                            <li class="step-1-img-wrap">
                                <img src="/images/consult-mb-03.png" class="consult consult-03">
                            </li>
                        </ul>
                        <div class="step-1-consult mb">
                        </div>
                    </div>
                    <!-- step-2 -->
                    <div class="step-2 step-box">
                        <div class="crown-wrap type2">
                            <img src="/images/crown4@2x.png" class="crown2" alt="">
                        </div>
                        <p class="title-num">2</p>
                        <p class="title">프로필 작성</p>
                        <p class="sub-title">
                            매력적으로 본인을 소개해 주시면,  <br  class="br-m"/>
                            디테일한 상담 내용을 토대로<br class="br-pc"/>
                            개인의 매력을 반영하여 매니저들이 보완, 수정하여
                            <br  class="br-m"/>프로필을 만듭니다.
                        </p>
                        <ul class="step-2-consult">
                            <li class="step-2-img-wrap">
                                <img src="/images/profile-01.png" class="profile-01">
                            </li>
                            <li class="step-2-img-wrap">
                                <img src="/images/profile-02.png" class="profile-02">
                            </li>
                            <li class="step-2-img-wrap">
                                <img src="/images/profile-03.png" class="profile-03">
                            </li>
                        </ul>
                    </div>
                    <!-- step-3 -->
                    <div class="step-3 step-box">
                        <div class="crown-wrap type2">
                            <img src="/images/crown4@2x.png" class="crown2" alt="">
                        </div>
                        <p class="title-num">3</p>
                        <p class="title">소개팅 매칭</p>
                        <p class="sub-title">
                            정량적, 정성적인 조건을 분석하여<br  class="br-m"/> 매칭 후 상대방 프로필 안내합니다.
                        </p>
                        <div class="step-3-consult">
                            <img src="/images/matching@2x.png" alt="" class="matching-pc">
                            <img src="/images/matching-m.png" alt="" class="matching-m">
                        </div>
                    </div>
                    <!-- step-4 -->
                    <div class="step-4 step-box">
                        <div class="crown-wrap type2">
                            <img src="/images/crown4@2x.png" class="crown2" alt="">
                        </div>
                        <p class="title-num">4</p>
                        <p class="title">일정&장소 조율</p>
                        <p class="sub-title">
                            매칭 확정 후, 소개팅 상대방과 소개팅 일정, <br  class="br-m"/>
                            장소를 조율합니다.<br class="br-pc" />
                            소개팅 확정 후 <br  class="br-m"/> 변경, 취소가 불가합니다.
                        </p>
                        <p class="warning-text">※ 지각, 비매너적인 행동은 회원 제명, <br  class="br-m"/>소개 횟수 차감으로 이어집니다.</p>
                        <div class="step-4-consult">
                            <img src="/images/calendar-01@2x.png" class="calendar-01">
                            <img src="/images/calendar-02@2x.png" class="calendar-02">
                        </div>
                    </div>
                    <!-- step-4 -->
                    <div class="step-4 step-box">
                        <div class="crown-wrap type2">
                            <img src="/images/crown4@2x.png" class="crown2" alt="">
                        </div>
                        <p class="title-num">5</p>
                        <p class="title">1:1 채팅방 오픈</p>
                        <p class="sub-title">
                            소개팅 전일 소개팅 상대방과의 1:1 채팅방이 오픈되며 간단한 인사만 나눠주세요.<br>
                            소개팅 1시간전 서로의 연락처가 <br  class="br-m"/>채팅방에 공유됩니다.
                        </p>
                        <div class="step-4-consult">
                            <img src="/images/chat@2x.png" alt="1:1채팅방">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="step-5">
            <div class="step-container">
                <div class="step-container-contents">
                    <div class="crown-wrap type2">
                        <img src="/images/crown4@2x.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">6</p>
                    <p class="title">소개팅</p>
                    <p class="sub-title">
                        예정된 소개팅 장소에서 설레는 만남 가져보아요.<br />
                        첫인상이 중요한 만큼 드레스코드는<br class="mb" /> 깔끔하게 준비해주세요!
                    </p>
                    <p class="warning-text">※ 지각은 상대방에 대한 예의가 아닙니다. <br class="mb" />예의를 지켜주세요!</p>
                </div>
            </div>
        </div>
        <!-- //stet-5 -->
        <div class="container">
            <div class="service-contents">
                <div class="step-6 step-box">
                    <div class="crown-wrap type2">
                        <img src="/images/crown4@2x.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">7</p>
                    <p class="title">피드백</p>
                    <p class="sub-title">
                        소개팅 이후 피드백을 작성해주세요!
                    </p>
                    <p class="warning-text">※ 추후 더 나은 소개팅을 위해 100% 소개팅 피드백을<br class="br-mb"/> 진행하고 있습니다.</p>
                    <div class="step-6-consult">
                        <img src="/images/feedback-01.png" class="feedback-01">
                        <img src="/images/feedback-02.png" class="feedback-02">
                    </div>
                </div>
            </div>
        </div>
        <!-- //step-6 -->
        <!-- step-7 -->
        <div class="step-7 step-box">
            <div class="step-container">
                <div class="step-container-contents">
                    <div class="crown-wrap type2">
                        <img src="/images/crown4@2x.png" class="crown2" alt="">
                    </div>
                    <p class="title-num">8</p>
                    <p class="title">컨설팅</p>
                    <p class="sub-title">
                        원할 시 본인에 대한 피드백 전달 가능합니다.<br />
                        (단, 상대방에 대한 마음을 전달하는 것은 아님을 알려드립니다.)
                    </p>
                </div>
            </div>
            <!-- 서비스 가격 -->
            <!--
            <div class="container">
                <div class="service-contents-price">
                    <div class="step-7-content">
                        <div class="crown-wrap type1">
                            <img src="/images/crown3@2x.png" class="crown3">
                        </div>
                        <p class="title">만날사람들 소개팅</p>
                        <p class="sub-title">
                            서비스 가격
                        </p>
                        <img src="/images/line-short.png" alt="" class="line">
                        <div class="step-7-consult">
                            <table>
                                <colgroup>
                                    <col width="30%">
                                    <col width="30%">
                                    <col width="30%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>연령</th>
                                    <th>프로그램</th>
                                    <th>가격(VAT포함)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td rowspan="3" class="row-color">- 25세</td>
                                    <td>1개월(1+1)</td>
                                    <td>220,000원</td>
                                </tr>
                                <tr>
                                    <td>2개월(2+2)</td>
                                    <td>396,000원</td>
                                </tr>
                                <tr class="line">
                                    <td>3개월(3+3)</td>
                                    <td>528,000원</td>
                                </tr>
                                <tr>
                                    <td rowspan="3" class="row-color">26 - 29세</td>
                                    <td>1개월(1+1)</td>
                                    <td>330,000원</td>
                                </tr>
                                <tr>
                                    <td>2개월(2+2)</td>
                                    <td>620,000원</td>
                                </tr>
                                <tr class="line">
                                    <td>3개월(3+3)</td>
                                    <td>870,000원</td>
                                </tr>
                                <tr>
                                    <td rowspan="3" class="row-color">30 - 34세</td>
                                    <td>1개월(1+1)</td>
                                    <td>440,000원</td>
                                </tr>
                                <tr>
                                    <td>2개월(2+2)</td>
                                    <td>840,000원</td>
                                </tr>
                                <tr class="line">
                                    <td>3개월(3+3)</td>
                                    <td>1,200,000원</td>
                                </tr>
                                <tr>
                                    <td rowspan="3" class="row-color">35 - 39세</td>
                                    <td>1개월(1+1)</td>
                                    <td>550,000원</td>
                                </tr>
                                <tr>
                                    <td>2개월(2+2)</td>
                                    <td>1,060,000원</td>
                                </tr>
                                <tr class="line">
                                    <td>3개월(3+3)</td>
                                    <td>1,530,000원</td>
                                </tr>
                                <tr>
                                    <td class="row-color">40세 -</td>
                                    <td colspan="2">소개팅 신청서 작성해 주세요</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
        <!--  //step-7-->

        <!-- //refund -->
        <div class="container">
            <div class="service-contents-price refund-blind">
                <div class="step-7-content">
                    <div class="crown-wrap type1">
                        <img src="/images/crown3.png" class="crown3">
                    </div>
                    <p class="title">만날사람들 소개팅</p>
                    <p class="sub-title">
                        이용약관 및 환불규정
                    </p>
                    <div class="line-wrap type1">
                        <img src="/images/line-short.png" alt="" class="line">
                    </div>
                    <div class="refund-blind-box top">
                        <p>만날사람들(이하 '회사')이 제공하는 소개팅 서비스에 가입하기 위하여 계약 내용을 인지하고 이용금액을 결제함으로써 <br class="br-re" />
                            해당 서비스의 가입 및 계약이 성립됩니다. 회사의 가입기준에 따라서 가입이 제한 또는 거절될 수 있으며 <br class="br-re" />그럴 경우에는 전액 환불 도와드리고 있습니다.</p>
                    </div>
                    <div class="refund-blind-box btm">
                        <p><span>01.</span> 만날사람들 가격표는 VAT가 포함된 가격이며, 정찰제로 운영됩니다.</p>
                        <p><span>02.</span> 프로그램은 연령대별로 가격이 상이합니다.</p>
                        <p><span>03.</span> 서비스 이용료 납부와 동시에 상담, 회원 등록, 매칭 등 소개팅 프로세스가 진행되기 때문에<br class="br-re" />
                            결제금액에서 이용금액과 위약금 20%를 제하고 환불 가능합니다.</p>
                        <p><span>04.</span> 첫 프로필 제공은 최소 2주가 소요됩니다.</p>
                        <p><span>05.</span> 첫 프로필 제공 후에 환불 요청 시에는 1회 차감 후 환불됩니다.</p>
                        <p><span>06.</span> 환불 가능 기간은 프로그램 기간동안이며, 환불액 산정은 남은 횟수/가입 횟수에 따라 산정됩니다.<br class="br-re" />
                            (즉, 추가 서비스 횟수가 제공된 경우, 환불 시에 추가 서비스 횟수를 제외하고
                            산정됩니다.)</p>
                        <p><span>07.</span> 프로필 수령 후 24시간 내에 소개팅 날짜, 장소를 조율해주세요. 24시간 내에 무응답일 경우,<br class="br-re" />
                            프로그램 진행 회피로 여겨 횟수 차감이나 불이익이 발생합니다</p>
                        <p><span>08.</span> 소개팅 확정 후에 취소나 변경 시에는 횟수 차감뿐만 아니라 프로그램 이용이 거절될 수 있습니다</p>
                        <p><span>09.</span> 회원권 이용기간은 프로그램 기간과 동일하며, 개인적인 사유(해외파견, 출장, 입원 등)로 추가 연장을 요구하는 경우는<br class="br-re" />
                            최대 프로그램 기간만큼 유효하며 서류 증빙 후 가능합니다. (단, 기간 연장의 경우 환불은 불가합니다.)</p>
                        <p><span>10.</span> 만날사람들을 통해 교제하거나 성혼하게 된 경우, 이용 목적이 달성되는 것으로 프로그램 종료이나 횟수가 남아 있으실 경우에는 <br class="br-re" />
                            가입하신 프로그램 기간만큼 연장 가능합니다.</p>
                        <p><span>11.</span> 회원 교제나 성혼의 이유로 이용이 불가할 때, 지인(신규회원)에게 양도 가능합니다</p>
                        <p><span>12.</span> 회원이 제출한 개인정보를 사실로 간주하며 허위로 의심되는 경우 진위 여부를 확인하기 위하여 당사자에게<br class="br-re" />
                            정보에 관하여 증명을 요구할 수 있으며 허위의 사실을 제출한 경우 서비스의 이용을 제한하거나 거부할 수 있으며 <br class="br-re" />
                            손해배상을 청구할 수 있으며, 회사의 과실과 책임은 없습니다.</p>
                    </div>
                    <img class="refund-logo" src="/images/LOGO.png" alt="">
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
            products: this.$page.props.products,
            payMethods: this.$page.props.payMethods,
            form: this.$inertia.form({
                page: 1,
                product_id: "",
                option_id: "",
                pay_method_id: "",
            }),
            agree1: 0,
            agree2: 0,
            active: false,
        }
    },
    methods: {
        order() {
            if(!this.agree1 || !this.agree2)
                return alert("필수 약관에 동의해주세요.");

            if(!this.form.option_id)
                return alert("참가비를 선택해주세요.");

            if(!this.form.pay_method_id)
                return alert("결제수단을 선택해주세요.");

            this.form.post("/orders");
        },
    },
    computed: {
        selectedProduct(){
            let target = this.$page.props.products.data.find(product => product.id == this.form.product_id);

            return  target ? target : "";
        },
        selectedOption(){
            console.log(this.selectedProduct);
            if(this.selectedProduct)
                return this.selectedProduct.options.find(option => option.id == this.form.option_id);

            return "";
        },
        totalPrice(){
            if(this.selectedProduct && this.selectedOption)
                return this.selectedProduct.price + this.selectedOption.price;

            return 0;
        }
    }
}
</script>
