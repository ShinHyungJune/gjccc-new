<template>
    <main class="loginpage login">
        <div class="login-container main-login">
            <div class="login-header">
                <img src="/images/login-logo.png" alt="login-logo" class="login-logo">
                <p class="login-header-title">우린 결국 <span class="text-style-1">만날 사람들</span>이었어</p>
                <img src="/images//log-line.png" alt="log-line">
                <p class="login-header-sub">
                    가장 친한 친구가 되어 찾아 줄게요
                </p>
            </div>
        </div>
        <div class="join-wrap">
            <div class="form-wrap form-join">
                <div class="con-wrap-header">
                    <p class="con-wrap-title">일반 회원가입</p>
                    <p class="con-wrap-sub">* 필수입력 </p>
                </div>

                <form action="" @submit.prevent="register">
                    <div class="con-wrap">
                        <ul class="form-box row-group">
                            <li class="row-group">
                                <p class="default">
                                    본인인증 <span>*</span>
                                </p>
                                <div class="user col-group ">
                                    <input type="text" placeholder="휴대폰 번호" v-model="form.contact" disabled>
                                    <span class="m-input-error">{{form.errors.contact}}</span>

                                    <button type="button" class="form-btn" @click.prevent="verify">
                                        인증하기
                                    </button>
                                </div>

                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이름(실명) <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" class="re-bg" placeholder="홍길동" v-model="form.name" disabled>
                                    <span class="m-input-error">{{form.errors.name}}</span>

                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    생년월일 <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="" v-model="form.birth" disabled>
                                    <span class="m-input-error">{{form.errors.birth}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    성별 <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="" v-model="form.sex" disabled>
                                    <span class="m-input-error">{{form.errors.sex}}</span>
                                </div>
                            </li>

                            <li class="row-group" v-if="!form.social_id">
                                <p class="default">
                                    이메일 <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="이메일 (이메일은 아이디로 사용됩니다)" v-model="form.email">

                                    <span class="m-input-error">{{form.errors.email}}</span>
                                </div>
                            </li>
                            <li class="row-group" v-if="!form.social_id">
                                <p class="default">
                                    비밀번호 <span>*</span>
                                </p>
                                <div class="user">
                                    <input class="input-gap" type="password" placeholder="비밀 번호" v-model="form.password">
                                    <input type="password" placeholder="비밀번호 재확인" v-model="form.password_confirmation">
                                    <span class="m-input-error">{{form.errors.password}}</span>
                                </div>
                            </li>

                            <li class="row-group">
                                <p class="default">
                                    직업 <span>*</span>
                                </p>
                                <div id="theme">
                                    <div class="select-close"></div>

                                    <div class="join-select-wrap">
                                        <select name="" id="" class="join-select" v-model="form.job">
                                            <option value="" disabled>직업을 선택해주세요</option>
                                            <option value="서비스 및 영업">서비스 및 영업</option>
                                            <option value="사무직">사무직</option>
                                            <option value="금융직">금융직</option>
                                            <option value="연구원/엔지니어">연구원/엔지니어</option>
                                            <option value="건축/설계">건축/설계</option>
                                            <option value="간호 및 의료사">간호 및 의료사</option>
                                            <option value="디자이너">디자이너</option>
                                            <option value="언론인">언론인</option>
                                            <option value="교사 및 강사">교사 및 강사</option>
                                            <option value="공무원 및 공공기관">공무원 및 공공기관</option>
                                            <option value="의사(한의,치의)/약사">의사(한의,치의)/약사</option>
                                            <option value="회계사">회계사</option>
                                            <option value="기타 전문직">기타 전문직</option>
                                            <option value="변호사 및 법조인">변호사 및 법조인</option>
                                            <option value="자영업 및 사업">자영업 및 사업</option>
                                            <option value="프리랜서">프리랜서</option>
                                            <option value="승무원 및 항공 관련 직업">승무원 및 항공 관련 직업</option>
                                            <option value="대학생/대학원생(석박사)">대학생/대학원생(석박사)</option>
                                            <option value="방송 관련 직업">방송 관련 직업</option>
                                            <option value="인플루언서">인플루언서</option>
                                            <option value="기타">기타</option>
                                        </select>

                                        <i class="xi-caret-down-min"></i>
                                    </div>

                                    <div class="m-input-error">{{form.errors.job}}</div>
                                </div>

                                <!--  셀렉트 -->
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    최종 학력 <span>*</span>
                                </p>
                                <div id="theme">
                                    <div class="join-select-wrap">
                                        <select name="" id="" v-model="form.school" class="join-select">
                                            <option value="" disabled>최종 학력을 선택해주세요</option>
                                            <option value="고졸 (취업한 경우 가능)">고졸 (취업한 경우 가능)</option>
                                            <option value="2년제 대졸">2년제 대졸</option>
                                            <option value="4년제 대졸">4년제 대졸</option>
                                            <option value="석사 졸업">석사 졸업</option>
                                            <option value="박사 졸업">박사 졸업</option>
                                        </select>

                                        <i class="xi-caret-down-min"></i>
                                    </div>

                                    <span class="m-input-error">{{form.errors.school}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    거주지 <span>*</span>
                                </p>

                                <input-region @change="(data) => {form.city = data.city; form.area = data.area;}" />

                                <span class="m-input-error" v-if="form.errors.city">{{form.errors.city}}</span>
                                <br/>
                                <span class="m-input-error" v-if="form.errors.area">{{form.errors.area}}</span>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이용 예정 서비스 <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="소개팅 or 파티" v-model="form.need_service">
                                    <span class="m-input-error">{{form.errors.need_service}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    가입 경로 <span>*</span>
                                </p>
                                <div id="theme">
                                    <div class="join-select-wrap">
                                        <select name="" id="" v-model="form.registration_way" class="join-select">
                                            <option value="" disabled>가입 경로를 선택해 주세요</option>
                                            <option value="인스타그램">인스타그램</option>
                                            <option value="페이스북">페이스북</option>
                                            <option value="유튜브">유튜브</option>
                                            <option value="네이버 블로그">네이버 블로그</option>
                                            <option value="네이버카페">네이버 카페</option>
                                            <option value="네이버 광고">네이버 광고</option>
                                            <option value="지인추천">지인추천</option>
                                            <option value="지인양도">지인양도</option>
                                            <option value="검색">검색</option>
                                            <option value="오프라인광고">오프라인광고</option>
                                        </select>

                                        <i class="xi-caret-down-min"></i>
                                    </div>

                                    <span class="m-input-error">{{form.errors.registration_way}}</span>
                                </div>
                            </li>
                        </ul>
                        <div class="notice-box">
                            <p>
                                <span class="text-style-1">소개팅 서비스</span> 이용을 원하신다면 <br>
                                아래의 <span class="text-style-1">선택입력사항</span>을 모두 입력해주세요
                            </p>
                        </div>
                        <ul class="form-box row-group">
                            <li class="row-group">
                                <p class="default">
                                    닉네임
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="소개팅 서비스 이용시 상대방에게 표시될 닉네임을 입력하세요" v-model="form.nickname">

                                    <span class="m-input-error">{{form.errors.nickname}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    근무지
                                </p>
                                <div class="user col-group">
                                    <input-region @change="(data) => {form.city_company = data.city; form.area_company = data.area;}" />
                                    <span class="m-input-error">{{form.errors.city_company}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    키
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="키를 입력해주세요" v-model="form.tall">
                                    <span class="m-input-error">{{form.errors.tall}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    몸무게를 입력해주세요
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="몸무게를 입력해주세요" v-model="form.weight">
                                    <span class="m-input-error">{{form.errors.weight}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    인스타그램 아이디
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="인스타그램 아이디를 입력해 주세요" v-model="form.instagram">
                                    <span class="m-input-error">{{form.errors.instagram}}</span>
                                </div>
                            </li>
                            <li class="row-group file">
                                <p class="default">
                                    프로필 사진 (최소 3장)
                                </p>
                                <div class="user">
                                    <input-imgs @change="(data) => {form.imgs = data}" />
                                    <span class="m-input-error">{{form.errors.imgs}}</span>

                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이상형
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="제가 생각하는 이상적인 연인은 서로 함께 있을 때 가장 즐겁고 재밌는사람입니다. 진중한 만남 기대하고 있습니다" v-model="form.ideal"></textarea>
                                    <span class="m-input-error">{{form.errors.ideal}}</span>

                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    자기소개글
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="안녕하세요.만나게 되어 반갑습니다. ^^ 저는 올해 31살이구 패션회사에서 벌써 7년간 근무했습니다. 워커홀릭으로 살아왔지만 여전히 사랑하시는 저희 부모님을 보면서 이제 저와 잘 맞는 짝을 만나 운동도 함께하고 맛집도 다니는 소소한 행복을 누리고 싶어 만날사람들을 찾게 되었습니다. 곧 만나뵐게요!♥" v-model="form.introduce"></textarea>
                                    <span class="m-input-error">{{form.errors.introduce}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    매니저에게 한마디
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="매니저에게 전하고 싶은 한마디를 입력해 주세요" v-model="form.to_manager"></textarea>
                                    <span class="m-input-error">{{form.errors.to_manager}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    결혼여부
                                </p>
                                <div id="theme">
                                    <div class="join-select-wrap">
                                        <select name="" id="" v-model="form.marriage" class="join-select">
                                            <option value="" disabled>혼인이력을 선택해 주세요</option>
                                            <option value="초혼">초혼</option>
                                            <option value="재혼">재혼</option>
                                        </select>

                                        <i class="xi-caret-down-min"></i>
                                    </div>

                                    <span class="m-input-error">{{form.errors.marriage}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <div class="terms">
                                    <p class="default">
                                        약관동의
                                    </p>
                                    <div class="all-check-contents">
                                        <label for="" @click="() => {agree1 = true; agree2 = true; form.agree_marketing = true;}">
                                            <input type="checkbox" id="" v-if="agree1 && agree2 && form.agree_marketing" checked>
                                            <input type="checkbox" id="" v-else>
                                            <span class="check-icon"></span>
                                            전체 동의
                                        </label>
                                    </div>
                                </div>
                                <!--  -->
                                <ul class="row-group terms-list">
                                    <li class="row-group terms-1">
                                        <div class="terms-agree">
                                            <label for="check1">
                                                <input type="checkbox" id="check1" v-model="agree1">
                                                <span class="check-icon"></span>
                                                이용약관 동의(필수)
                                            </label>
                                        </div>
                                        <a href="/privacy02" target="_blank"><i class="xi-angle-right term-arrow"></i></a>
                                    </li>
                                    <li class="row-group  terms-1">
                                        <div class="terms-agree">
                                            <label for="check2">
                                                <input type="checkbox" id="check2" v-model="agree2">
                                                <span class="check-icon"></span>
                                                개인정보 수집 및 이용에 대한 동의 (필수)
                                            </label>
                                        </div>
                                        <a href="/privacy01" target="_blank"><i class="xi-angle-right term-arrow"></i></a>
                                    </li>
                                    <li class="row-group  terms-1">
                                        <div class="terms-agree">
                                            <label for="check3">
                                                <input type="checkbox" id="check3" v-model="form.agree_marketing">
                                                <span class="check-icon"></span>
                                                광고 및 마케팅 활용 동의 (선택)
                                            </label>
                                        </div>
                                        <a href="/privacy03" target="_blank"><i class="xi-angle-right term-arrow"></i></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="duty-box ">
                        <p class="duty-title">회원의 의무</p>
                        <p class="duty-sub">회원이 기입한 정보는 모두 사실인 것으로 간주합니다. </br>
                            법률상 혼인이력이 있거나, 위조된 서류로 인증을 하는 경우 </br>
                            즉시 이용계약이 해지 되며 이로 인해 발생하는 <br class="mb" />회사측 손해에 대해서는 </br>
                            향후 구상권이 청구될 수 있습니다.</p>
                        <div class="duty-label">
                            <label for="duty-check">
                                <input type="checkbox" id="duty-check" v-model="agree4">
                                <span class="check-icon"></span>
                                회원의 의무를 모두 확인했으며 이에 동의합니다.
                            </label>
                        </div>

                    </div>
                    <button type="submit" class="submit-duty-btn">회원가입</button>
                </form>
            </div>
        </div>
    </main>
</template>
<script>
import InputVerifyNumber from "../../Components/Form/InputVerifyNumber";
import {Link} from "@inertiajs/inertia-vue";
import InputAddress from "../../Components/Form/InputAddress";
import InputRegion from "../../Components/Form/InputRegion";
import InputImgs from "../../Components/Form/InputImgs";

export default {
    components: {InputImgs, InputRegion, InputAddress, Link, InputVerifyNumber},
    data(){
        return {
            agree: 0,
            verification: this.$page.props.verification ? this.$page.props.verification.data : "",
            form: this.$inertia.form({
                email: this.$page.props.user ? this.$page.props.user.data.email : "",
                contact: this.$page.props.user ? this.$page.props.user.data.contact : "",
                name: this.$page.props.user ? this.$page.props.user.data.name : "",
                sex: this.$page.props.user ? this.$page.props.user.data.sex : "",
                birth: this.$page.props.user ? this.$page.props.user.data.birth : "",
                job: this.$page.props.user ? this.$page.props.user.data.job : "",
                school: this.$page.props.user ? this.$page.props.user.data.school : "",
                city: this.$page.props.user ? this.$page.props.user.data.city : "",
                area: this.$page.props.user ? this.$page.props.user.data.area : "",
                need_service: this.$page.props.user ? this.$page.props.user.data.need_service : "",
                registration_way: this.$page.props.user ? this.$page.props.user.data.registration_way : "",
                nickname: this.$page.props.user ? this.$page.props.user.data.nickname : "",
                city_company: this.$page.props.user ? this.$page.props.user.data.city_company : "",
                area_company: this.$page.props.user ? this.$page.props.user.data.area_company : "",
                tall: this.$page.props.user ? this.$page.props.user.data.tall : "",
                weight: this.$page.props.user ? this.$page.props.user.data.weight : "",
                instagram: this.$page.props.user ? this.$page.props.user.data.instagram : "",
                ideal: this.$page.props.user ? this.$page.props.user.data.ideal : "",
                introduce: this.$page.props.user ? this.$page.props.user.data.introduce : "",
                to_manager: this.$page.props.user ? this.$page.props.user.data.to_manager : "",
                marriage: this.$page.props.user ? this.$page.props.user.data.marriage : "",
                password: this.$page.props.user ? this.$page.props.user.data.password : "",
                password_confirmation: this.$page.props.user ? this.$page.props.user.data.password_confirmation : "",
                agree_marketing: this.$page.props.user ? this.$page.props.user.data.agree_marketing : false,
                imgs: [],
                imp_uid: "",
                merchant_uid: "",
                social_platform: "",
                social_id: "",
            }),
            agree1: false,
            agree2: false,
            agree4: false,

            appUrl: this.$page.props.appUrl,
            verificationForm: this.$inertia.form({
                imp_uid: "",
                merchant_uid: "",
            }),
        }
    },

    methods: {
        register() {
            if(!this.agree1 || !this.agree2 || !this.agree4)
                return alert("필수약관에 동의해주세요.");

            if(!this.form.contact)
                return alert("인증하기 버튼을 눌러 본인인증을 먼저 진행해주세요.");

            this.form.post("/users");
        },

        clearLetter(){
            this.form.contact = this.form.contact.replace(/-/g, '');
        },

        verified(data){
            this.form.contact = data;
        },

        verify(){
            let date = new Date();

            let self = this;

            let IMP = window.IMP; // 생략 가능

            IMP.init(this.$page.props.impId);

            IMP.certification({ // param
                merchant_uid: date.getMilliseconds(), // 주문 번호
                m_redirect_url : self.form.social_id ? `${self.appUrl}/verifications/complete?social_id=${self.form.social_id}&social_platform=${self.form.social_platform}` : `${self.appUrl}/verifications/complete`, // 모바일환경에서 popup:false(기본값) 인 경우 필수, 예: https://www.myservice.com/payments/complete/mobile
                popup : false // PC환경에서는 popup 파라메터가 무시되고 항상 true 로 적용됨
            }, function (rsp) { // callback
                if (rsp.success) {
                    self.form.imp_uid = rsp.imp_uid;
                    self.form.merchant_uid = rsp.merchant_uid;

                    axios.post("/api/verifications", {
                        imp_uid: rsp.imp_uid,
                        merchant_uid: rsp.merchant_uid,
                    }).then(response => {
                        let item = response.data.data;

                        self.form.contact = item.phone;
                        self.form.sex = item.sex;
                        self.form.birth = item.birth;
                        self.form.name = item.name;
                    }).catch(error => {
                        return alert("인증에 실패하였습니다.");
                    });
                } else {
                    alert("인증에 실패하였습니다.");
                }
            });
        },


    },

    mounted() {
        let params = new URLSearchParams(window.location.search);

        if(params.get("social_id"))
            this.form.social_id = params.get("social_id");

        if(params.get("social_platform"))
            this.form.social_platform = params.get("social_platform");

        if(this.verification) {
            this.form.contact = this.verification.phone;
            this.form.sex = this.verification.sex;
            this.form.birth = this.verification.birth;
            this.form.name = this.verification.name;
            this.form.imp_uid = this.verification.imp_uid;
        }

    }
}
</script>
