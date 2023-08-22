<template>
    <main class="subpage mypage mypage-edit">

        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Mypage</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 마이페이지</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 프로필 수정</a></li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="mypage-wrap col-group">
            <sidebar />

            <div class="right-wrap">
                <div class="title-wrap col-group">
                    <h2>프로필 수정</h2>
                </div>
                <div class="con-wrap form-wrap">
                    <form action="" @submit.prevent="update">
                        <ul class="form-box row-group">
                            <li class="row-group">
                                <p class="default">
                                    이메일 <span>*</span>
                                </p>
                                <div class="user col-group nonedit">
                                    <p>{{ user.email }}</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    비밀번호 <span>*</span>
                                </p>
                                <div class="user col-group">
                                    <a href="/passwordResets/create" class="form-btn">
                                        비밀번호 변경
                                    </a>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    휴대폰 번호 <span>*</span>
                                </p>
                                <div class="user col-group nonedit">
                                    <p>{{ user.contact }}</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이름(실명)
                                </p>
                                <div class="user nonedit">
                                    <p>{{ user.name }}</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    생년월일
                                </p>
                                <div class="user nonedit">
                                    <p>{{ user.birth }}</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    성별
                                </p>
                                <div class="user nonedit">
                                    <p>{{ user.sex }}</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    직업 <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="" class="join-select" v-model="form.job">
                                        <option value="" disabled>직업을 선택해주세요.</option>
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

                                    <div class="m-input-error">{{form.errors.job}}</div>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    최종 학력 <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="" v-model="form.school" class="join-select">
                                        <option value="" disabled>최종 학력을 선택해주세요.</option>
                                        <option value="고졸 (취업한 경우 가능)">고졸 (취업한 경우 가능)</option>
                                        <option value="2년제 대졸">2년제 대졸</option>
                                        <option value="4년제 대졸">4년제 대졸</option>
                                        <option value="석사 졸업">석사 졸업</option>
                                        <option value="박사 졸업">박사 졸업</option>
                                    </select>
                                    <span class="m-input-error">{{form.errors.school}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    거주지 <span>*</span>
                                </p>
                                <input-region :area="form.area" :city="form.city" @change="(data) => {form.city = data.city; form.area = data.area;}" />

                                <span class="m-input-error">{{form.errors.city}}</span>
                                <br/>
                                <span class="m-input-error">{{form.errors.area}}</span>
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
                                <div class="user">
                                    <select name="" id="" v-model="form.registration_way" class="join-select">
                                        <option value="" disabled>가입 경로를 선택해 주세요.</option>
                                        <option value="네이버 블로그">네이버 블로그</option>
                                        <option value="네이버 광고">네이버 광고</option>
                                        <option value="지인추천">지인추천</option>
                                        <option value="검색">검색</option>
                                    </select>
                                </div>

                                <span class="m-input-error">{{form.errors.registration_way}}</span>
                            </li>
                        </ul>
                        <div class="notice-box">
                            <p>
                                <span class="text-style-1">소개팅 서비스</span> 이용을 원하신다면 <br>
                                아래의 <span class="text-style-1">선택입력사항</span>을 모두 입력해 주세요
                            </p>
                        </div>
                        <ul class="form-box row-group">
                            <li class="row-group">
                                <p class="default">
                                    닉네임
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="소개팅 서비스 이용시 상대방에게 표시될 닉네임을 입력하세요." v-model="form.nickname">

                                    <span class="m-input-error">{{form.errors.nickname}}</span>
                                </div>
                            </li>

                            <li class="row-group">
                                <p class="default">
                                    근무지
                                </p>
                                <div class="user col-group">
                                    <input-region :city="form.city_company" :area="form.area_company" @change="(data) => {form.city_company = data.city; form.area_company = data.area;}" />
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
<!--                            <li class="row-group file">
                                <p class="default">
                                    대표 프로필 사진
                                </p>
                                <div class="user">
                                    <input-imgs id="img" :multiple="false" :default-files="[user.img]" @change="(data) => {form.img = data[0]}" />
                                    <span class="m-input-error">{{form.errors.img}}</span>
                                </div>
                            </li>-->
                            <li class="row-group file">
                                <p class="default">
                                    프로필 사진 (최소 3장)
                                </p>
                                <div class="user">
                                    <input-imgs id="imgs" :default-files="user.imgs" @change="(data) => {form.imgs = data}" />
                                    <span class="m-input-error">{{form.errors.imgs}}</span>

                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이상형
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="제가 생각하는 이상적인 연인은 서로 함께 있을 때 가장 즐겁고 재밌는사람입니다. 진중한 만남 기대하고 있습니다." v-model="form.ideal"></textarea>
                                    <span class="m-input-error">{{form.errors.ideal}}</span>

                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    자기소개글
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="안녕하세요.만나게 되어 반갑습니다. ^^ 저는 올해 31살이구 패션회사에서 벌써 7년간 근무했습니다. 워커홀릭으로 살아왔지만 여전히 사랑하시는 저희 부모님을 보면서 이제 저와 잘 맞는 짝을 만나 운동도 함께하고 맛집도 다니는 소소한 행복을 누리고 싶어 인사를 찾게 되었습니다. 곧 만나뵐게요!♥" v-model="form.introduce"></textarea>
                                    <span class="m-input-error">{{form.errors.introduce}}</span>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    매니저에게 한마디
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="매니저에게 전하고 싶은 한마디를 입력해 주세요." v-model="form.to_manager"></textarea>
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
                                            <option value="" disabled>혼인이력을 선택해 주세요.</option>
                                            <option value="초혼">초혼</option>
                                            <option value="재혼">재혼</option>
                                        </select>

                                        <i class="xi-caret-down-min"></i>
                                    </div>

                                    <span class="m-input-error">{{form.errors.marriage}}</span>
                                </div>
                            </li>
                        </ul>

                        <button type="submit" class="submit-btn">정보 수정</button>

                    </form>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";
import Sidebar from "../../Components/Sidebar";
import InputAddress from "../../Components/Form/InputAddress";
import InputRegion from "../../Components/Form/InputRegion";
import InputImgs from "../../Components/Form/InputImgs";

export default {
    components: {InputImgs, InputRegion, InputAddress, Sidebar, State, Link, Pagination},
    data(){
        return {
            willChangePassword: false,
            user: this.$page.props.user.data,
            form: this.$inertia.form({
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
                imgs: "",
                img: "",
            })
        }
    },
    methods:{
        update(){
            this.form.post("/users/update", {
                onSuccess: () => {
                    this.willChangePassword = false;

                    this.user = this.$page.props.user.data;
                }
            });
        }
    }
}
</script>
