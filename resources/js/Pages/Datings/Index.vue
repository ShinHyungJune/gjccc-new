<template>
    <main class="subpage mypage">

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
                        <li><a href="#"> 소개팅 목록</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mypage-wrap col-group">
            <sidebar />

            <div class="right-wrap">
                <div class="title-wrap col-group">
                    <a href="/datings"><h2>소개팅 목록</h2></a>

                    <ul class="tab-link col-group">
                        <li :class="form.state === '진행중' ? 'active' : ''" @click="() => {form.state = '진행중'; filter();}">진행중</li>
                        <li :class="form.state === '완료' ? 'active' : ''" @click="() => {form.state = '완료'; filter();}">완료</li>
                    </ul>
                </div>

                <div class="tab-content active">
                    <ul class="date-wrap col-group">
                        <li class="date-box" v-for="dating in datings.data" :key="dating.id">
                            <span :class="`state-label ${dating.ongoing ? 'ongoing' : ''}`">{{dating.ongoing ? '진행중' : '종료'}}</span>
                            <span :class="alarmClass(dating)"><i class="xi-bell"></i></span>
                            <div class="user-profile">
                                <div class="user-photo" :style="`background-image:url(${partner(dating) && partner(dating).img ? partner(dating).img.url : ''}); background-repeat:no-repeat; background-size:100%; background-position:center;`"></div>
                                <div class="txt-box">
                                    <p class="user-name">
                                        {{partner(dating) ? partner(dating).displayName : '탈퇴유저'}}
                                     </p>
                                    <div class="user-info col-group" v-if="partner(dating)">
                                        <p>{{partner(dating).formatBirth}}년생</p>
                                        /
                                        <p>{{ partner(dating).city }} 거주</p>
                                    </div>
                                    <div class="user-info col-group" v-else>
                                        <p>탈퇴유저</p>
                                    </div>
                                </div>
                                <a href="#" class="profile-btn" @click.prevent="targetDating = dating" v-if="partner(dating)">프로필 상세보기</a>
                            </div>

                            <ul class="date-detail">
                                <li class="col-group">
                                    <p class="default">
                                        장소
                                    </p>
                                    <div class="user">
                                        <!-- 장소 확인 시 -->
                                        <p v-if="dating.check_address">{{ dating.place_name }}</p>

                                        <!-- STEP01 일정제안대기 -->
                                        <p v-if="!dating.check_address">미정</p>

                                        <!-- STEP02 여자 | 일정제안 & 장소옴  -->
                                        <a href="#" class="date-btn active" v-if="dating.ongoing && !dating.check_address && user.sex === '여자' && dating.place_url" @click="targetAddressDating = dating">장소확인</a>

                                        <!-- STEP02 남자 | 일정제안  -->
                                        <a href="#" class="date-btn active" v-if="dating.ongoing && !dating.check_address && user.sex === '남자' && dating.city1 && !dating.address_name" @click="targetSuggestAddressDating = dating">장소제안</a>
                                        <a href="#" class="date-btn" v-if="dating.ongoing && !dating.check_address && user.sex === '남자' && !dating.city1">장소제안</a>

                                        <a v-if="dating.check_address" :href="dating.place_url" target="_blank" class="date-btn map">지도보기</a>

                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">
                                        일정
                                    </p>
                                    <div class="user">
                                        <p v-if="!dating.scheduled_at">미정</p>
                                        <p v-else>{{ dating.scheduled_at }}</p>

                                        <!-- STEP01 일정제안대기 -->
                                        <a href="#" v-if="dating.ongoing && user.sex === '여자' && !dating.city1" class="date-btn active" @click.prevent="targetSuggestSchedule = dating">일정제안</a>

                                        <!-- STEP01 일정제안대기 -->
                                        <a href="#" v-if="dating.ongoing && user.sex === '남자' && !dating.city1" class="date-btn">일정도착</a>
                                        <a href="#" v-if="!dating.check_address && dating.ongoing && user.sex === '남자' && dating.city1" class="date-btn active" style="color:black; background-color:transparent;">일정도착</a>

                                    </div>
                                </li>
                            </ul>
                            <!-- 데이트 최종 매칭 & 종료 -->
                            <a href="#" :class="`chat-btn ${dating.already_feedback ? '' : 'active'}`" v-if="!dating.ongoing && dating.check_address" @click.prevent="() => {!dating.already_feedback ? targetFeedbackDating = dating : ''}">
                                <p>후기 남기기</p>
                            </a>
                            <!-- 데이트 매칭 & 1일정 채팅 열림 -->
                            <a :href="`/chats/${dating.id}`" class="chat-btn active" v-else-if="dating.can_chat">
                                <p>1:1 채팅창 열기<span class="badge" v-if="dating.has_new_message"></span></p>
                            </a>

                            <!-- 채팅 열림 전 -->
                            <a href="#" @click.prevent="" class="chat-btn" v-else>
                                <p>1:1 채팅창 열기</p>
                            </a>
                        </li>
                    </ul>

                    <div class="m-empty type01" v-if="datings.data.length === 0">
                        데이터가 없습니다.
                    </div>
                </div>

                <!-- 프로필 도착 -->
                <div class="modal-overley only open" v-if="latestUnreadDating">
                    <div class="modal-wrap">
                        <button type="button" class="close" @click="latestUnreadDating = ''">
                            <i class="xi-close"></i>
                        </button>
                        <div class="title-wrap only">
                            <img src="/images/crown2.png" alt="">
                            <h2 class="title">
                                새 프로필 도착
                            </h2>
                            <p class="txt"></p>
                        </div>
                        <div class="txt-box">
                            새로운 소개팅 프로필이 도착했습니다 <br>
                            확인하시겠습니까?
                        </div>
                        <button type="button" class="submit-btn check-profile" @click="targetDating = latestUnreadDating">확인</button>
                    </div>
                </div>

                <!-- 프로필 확인 -->
                <div class="modal-overley check-profile open" v-if="targetDating">
                    <div class="modal-wrap profile">
                        <button type="button" class="close" @click="targetDating = ''">
                            <i class="xi-close"></i>
                        </button>
                        <div class="profile-wrap col-group">
                            <div class="left-wrap col-group">
                                <div class="user-profile">
                                    <div class="user-photo">
                                        <div class="img-box" :style="`background-image:url(${partner(targetDating).img ? partner(targetDating).img.url : ''}); background-repeat:no-repeat; background-size:100%; background-position:center;`"></div>
                                    </div>
                                    <div class="txt-box">
                                        <p class="user-name">
                                            {{ partner(targetDating).displayName }}
                                        </p>
                                        <div class="user-info-1 col-group">
                                            <p>{{ partner(targetDating).formatBirth }}년생</p>
                                            /
                                            <p>{{ partner(targetDating).city }} 거주</p>
                                        </div>
                                        <div class="user-info-2 row-group">
                                            <p>{{ partner(targetDating).job }}</p>
                                            <p>{{ partner(targetDating).school }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-box row-group">
                                    <div class="txt-box">
                                        <h3 class="title">이상형</h3>
                                        <pre class="txt" v-text="partner(targetDating).ideal"></pre>
                                    </div>
                                    <div class="txt-box">
                                        <h3 class="title">자기소개</h3>
                                        <pre class="txt" v-text="partner(targetDating).introduce"></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="right-wrap">
                                <div class="comment-box">
                                    <h3 class="title">매니저 코멘트</h3>
                                    <ul class="comment-list row-group">
                                        <li v-if="partner(targetDating).comment1"><pre class="txt" v-text="partner(targetDating).comment1"></pre></li>
                                        <li v-if="partner(targetDating).comment2"><pre class="txt" v-text="partner(targetDating).comment2"></pre></li>
                                        <li v-if="partner(targetDating).comment3"><pre class="txt" v-text="partner(targetDating).comment3"></pre></li>
                                        <li v-if="partner(targetDating).comment4"><pre class="txt" v-text="partner(targetDating).comment4"></pre></li>
                                        <li v-if="partner(targetDating).comment5"><pre class="txt" v-text="partner(targetDating).comment5"></pre></li>
                                    </ul>
                                </div>
                                <div class="btn-wrap col-group">
                                    <button type="button" @click="read(targetDating)">확인완료</button>
<!--                                    <a href="http://pf.kakao.com/_kvwsxj" class="kakao-btn">
                                        <i class="xi-kakaotalk"></i> 카톡문의
                                    </a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //프로필 확인 -->
                </div>

                <!-- 프로필 확인 후 안내 -->
                <div class="modal-overley go open" v-if="activeGuide && user.sex === '여자'">
                    <!-- 일정 안내 -->
                    <div class="modal-wrap">
                        <button type="button" class="close" @click="activeGuide = false">
                            <i class="xi-close"></i>
                        </button>
                        <div class="title-wrap only">
                            <img src="/images/crown2.png" alt="">
                            <h2 class="title">
                                일정안내
                            </h2>
                            <p class="txt"></p>
                        </div>
                        <div class="txt-box">
                            소개팅 일정은 24시간 이내에 결정해<br />
                            상대방에게 전송해 주세요
                        </div>
                        <button type="button" class="submit-btn" @click="activeGuide = false">확인</button>
                    </div>
                    <!-- //일정안내 -->
                </div>

                <!-- 장소 확인 -->
                <div class="modal-overley location-check open" v-if="targetAddressDating">
                    <div class="modal-wrap">
                        <button type="button" class="close" @click="targetAddressDating = ''">
                            <i class="xi-close"></i>
                        </button>
                        <div class="title-wrap">
                            <img src="/images/crown2.png" alt="">
                            <h2 class="title">
                                장소확인
                            </h2>
                            <p class="txt">
                                장소와 일정은 선호지역과 일정을 통해 선택되었습니다. <br>
                                이후 다른 일정으로 변경을 원하신다면 정해진 일정 하루전 열리는 <br>
                                채팅창을 통해 상대방 동의하에 가능합니다
                            </p>
                        </div>
                        <div class="form-wrap">
                            <div class="search-wrap form-box only">
                                <div class="search-result">
                                    <div class="col-group">
                                        <div class="txt-box">
                                            <p class="add">
                                                {{ targetAddressDating.place_name }}
                                            </p>
                                            <p class="add-detail">
                                                {{ targetAddressDating.address_name }}
                                            </p>
                                        </div>
                                        <a :href="targetAddressDating.place_url" target="_blank" type="button" class="map-btn">
                                            지도보기
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_1">
                                            <input type="radio" name="date_list" id="list_1" checked nonedit>
                                            <span class="radio-icon"></span>
                                            선호 일정
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetAddressDating.scheduled_at }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="submit-btn" @click="checkAddress(targetAddressDating)">확인</button>
                    </div>
                    <!-- //장소 확인 -->
                </div>

                <!-- 장소 제안 -->
                <!--
                <div class="modal-overley location open" v-if="targetSuggestAddressDating">
                -->
                <div class="modal-overley location open" v-if="targetSuggestAddressDating">
                    <div class="modal-wrap">
                        <button type="button" class="close" @click="targetSuggestAddressDating = false">
                            <i class="xi-close"></i>
                        </button>
                        <div class="title-wrap">
                            <img src="/images/crown2.png" alt="">
                            <h2 class="title">
                                장소제안
                            </h2>
                            <p class="txt">
                                장소는 상대방의 선호지역을 참고해 선택해 주세요 <br>
                                상대의 선호 일정중 하나를 선택해 주세요
                            </p>
                        </div>
                        <div class="form-wrap overflow">
                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <p class="default">선호지역1</p>
                                    <div class="user col-group nonedit">
                                        <p class="disabled">{{ targetSuggestAddressDating.city1 }}</p>
                                        <p class="disabled">{{ targetSuggestAddressDating.area1 }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">선호지역2</p>
                                    <div class="user col-group nonedit">
                                        <p class="disabled">{{ targetSuggestAddressDating.city2 }}</p>
                                        <p class="disabled">{{ targetSuggestAddressDating.area2 }}</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="search-wrap form-box">
                                <!-- 장소명 찾아서 있을 때 -->
                                <div v-if="!activeInputAddress">
                                    <form action="" @submit.prevent="search">
                                        <div class="search-box">
                                            <input type="text" placeholder="소개팅 장소를 검색해 주세요" v-model="word">
                                            <span class="sticker" @click="search"><i class="xi-search"></i></span>
                                        </div>
                                    </form>

                                    <div class="search-result" v-if="places.length > 0">
                                        <div class="col-group" v-for="(place, index) in places" :key="index">
                                            <div class="txt-box">
                                                <p class="add">
                                                    {{ place.place_name }}
                                                </p>
                                                <p class="add-detail">
                                                    {{ place.address_name }}
                                                </p>
                                            </div>
                                            <a href="#" target="_blank" type="button" class="map-btn" @click.prevent="selectPlace(place)">{{form.place_name === place.place_name ? '선택됨' : '선택하기'}}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- 장소명 찾아서 없을 때 -->
                                <input-address
                                    @change="(data) => {form.place_url = data.place_url; form.address = data.address}" :form="form"
                                    @changeAddressDetail="(data) => {form.place_name = data; form.address_name = form.address + ' ' + form.place_name}"
                                    v-else
                                />



                                <div class="m-input-error">{{form.errors.place_name}}</div>
                                <div class="m-input-error">{{form.errors.address_name}}</div>
                                <div class="m-input-error">{{form.errors.place_url}}</div>
                            </div>
                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_1">
                                            <input type="radio" name="date_list" id="list_1" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule1">
                                            <span class="radio-icon"></span>
                                            선호 일정1
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule1 }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_2">
                                            <input type="radio" name="date_list" id="list_2" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule2">
                                            <span class="radio-icon"></span>
                                            선호 일정2
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule2 }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_3">
                                            <input type="radio" name="date_list" id="list_3" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule3">
                                            <span class="radio-icon"></span>
                                            선호 일정3
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule3 }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_4">
                                            <input type="radio" name="date_list" id="list_4" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule4">
                                            <span class="radio-icon"></span>
                                            선호 일정4
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule4 }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_5">
                                            <input type="radio" name="date_list" id="list_5" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule5">
                                            <span class="radio-icon"></span>
                                            선호 일정5
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule5 }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <div class="default">
                                        <label for="list_6">
                                            <input type="radio" name="date_list" id="list_6" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule6">
                                            <span class="radio-icon"></span>
                                            선호 일정6
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule6 }}</p>
                                    </div>
                                </li>
                                <li class="col-group" v-if="form.schedule7">
                                    <div class="default">
                                        <label for="list_7">
                                            <input type="radio" name="date_list" id="list_7" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule7">
                                            <span class="radio-icon"></span>
                                            선호 일정7
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule7 }}</p>
                                    </div>
                                </li>
                                <li class="col-group" v-if="form.schedule8">
                                    <div class="default">
                                        <label for="list_8">
                                            <input type="radio" name="date_list" id="list_89" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule8">
                                            <span class="radio-icon"></span>
                                            선호 일정8
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule8 }}</p>
                                    </div>
                                </li>
                                <li class="col-group" v-if="form.schedule9">
                                    <div class="default">
                                        <label for="list_9">
                                            <input type="radio" name="date_list" id="list_9" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule9">
                                            <span class="radio-icon"></span>
                                            선호 일정9
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule9 }}</p>
                                    </div>
                                </li>
                                <li class="col-group" v-if="form.schedule10">
                                    <div class="default">
                                        <label for="list_10">
                                            <input type="radio" name="date_list" id="list_10" v-model="form.scheduled_at" :value="targetSuggestAddressDating.schedule10">
                                            <span class="radio-icon"></span>
                                            선호 일정10
                                        </label>
                                    </div>
                                    <div class="user col-group">
                                        <p>{{ targetSuggestAddressDating.schedule10 }}</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="m-input-error">{{form.errors.scheduled_at}}</div>
                        </div>
                        <button type="button" class="submit-btn" @click="suggestAddress(targetSuggestAddressDating)">장소 제안</button>
                    </div>
                </div>

                <!-- 일정 제안 -->
                <div class="modal-overley location open" v-if="targetSuggestSchedule">
                    <div class="modal-wrap">
                        <button type="button" class="close" @click="targetSuggestSchedule = false">
                            <i class="xi-close"></i>
                        </button>
                        <div class="title-wrap">
                            <img src="/images/crown2.png" alt="">
                            <h2 class="title">
                                일정제안
                            </h2>
                            <p class="txt">
                                선호지역은 상대방의 거주지와 근무지를 참고해 작성해 주세요.
                                <br/>일정은 5개까지 설정 가능하며 최대 2주 안으로 선택해 주세요.
                            </p>
                        </div>
                        <div class="form-wrap overflow">
                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <p class="default">상대 거주지</p>
                                    <div class="user col-group nonedit">
                                        <p class="disabled">{{ partner(targetSuggestSchedule).city }}</p>
                                        <p class="disabled">{{ partner(targetSuggestSchedule).area }}</p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">상대 근무지</p>
                                    <div class="user col-group nonedit disabled">
                                        <p class="disabled">{{ partner(targetSuggestSchedule).city_company }}</p>
                                        <p class="disabled">{{ partner(targetSuggestSchedule).area_company }}</p>
                                    </div>
                                </li>
                            </ul>

                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <p class="default">선호지역1</p>
                                    <input-cities @change="(data) => {form.city1 = data.city; form.area1 = data.area}" />
                                </li>
                                <p class="m-input-error type01">{{ form.errors.city1 }}</p>

                                <li class="col-group">
                                    <p class="default">선호지역2</p>
                                    <input-cities @change="(data) => {form.city2 = data.city; form.area2 = data.area}" />
                                </li>
                                <p class="m-input-error type01">{{ form.errors.city2 }}</p>
                            </ul>

                            <ul class="form-box row-group">
                                <li class="col-group">
                                    <p class="default">선호일정1 <span class="star">*</span></p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule1" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule1 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정2 <span class="star">*</span></p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule2" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule2 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정3 <span class="star">*</span></p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule3" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule3 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정4 <span class="star">*</span></p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule4" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule4 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정5 <span class="star">*</span></p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule5" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule5 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정6 <span class="star">*</span></p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule6" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule6 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정7</p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule7" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule7 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정8</p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule8" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule8 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정9</p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule9" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule7 }}</p>

                                <li class="col-group">
                                    <p class="default">선호일정10</p>
                                    <div class="user col-group nonedit disabled">
                                        <input type="datetime-local" :min="now" v-model="form.schedule10" />
                                    </div>
                                </li>
                                <p class="m-input-error type01">{{ form.errors.schedule10 }}</p>
                            </ul>
                        </div>
                        <button type="button" class="submit-btn" @click="suggestSchedule(targetSuggestSchedule)">일정 제안</button>
                    </div>
                </div>

                <!-- 후기 남기기 -->
                <div class="modal-overley review open" v-if="targetFeedbackDating">
                    <!-- 소개팅 리뷰 -->
                    <div class="modal-wrap review">
                        <button type="button" class="close" @click="targetFeedbackDating = ''">
                            <i class="xi-close"></i>
                        </button>
                        <div class="title-wrap profile-wrap">
                            <img src="/images/crown2.png" alt="">
                            <div class="user-profile">
                                <div class="img-wrap">
                                    <img src="/images/crown2.png" alt="">
                                </div>
                                <div class="user-photo">
                                    <div class="img-box" :style="`background-image:url(${partner(targetFeedbackDating).img ? partner(targetFeedbackDating).img.url : ''}); background-repeat:no-repeat; background-size:100%; background-position:center;`"></div>
                                </div>
                                <div class="txt-box">
                                    <p class="user-name">
                                        {{ partner(targetFeedbackDating).name }}
                                    </p>
                                    <div class="user-info-1 col-group">
                                        <p>{{ partner(targetFeedbackDating).formatBirth }}년생</p>
                                        /
                                        <p>{{ partner(targetFeedbackDating).city }}거주</p>
                                    </div>
                                </div>
                            </div>
                            <p class="txt">
                                오늘 소개팅 어떠셨을까요? 소개팅 피드백 남겨주세요! <br>
                                피드백 주신 내용이 이 후 매칭에 반영되어 진행됩니다. <br>
                                더 좋은 소개팅을 위해서 인사가 노력하겠습니다♥
                            </p>
                        </div>
                        <div class="review-wrap form-wrap overflow">
                            <form action="">
                                <ul class="review-box form-box row-group">
                                    <li>
                                        <div class="qs">
                                            <p class="num">1</p>
                                            <p class="txt">
                                                오늘 소개팅 어떠셨나요?
                                            </p>
                                        </div>
                                        <ul class="as row-group">
                                            <li>
                                                <label for="qna1_1">
                                                    <input type="radio" name="qna1" id="qna1_1" value="저와 인연이 아닙니다." v-model="feedbackForm.how_about_dating">
                                                    <span class="radio-icon"></span>
                                                    1. 저와 인연이 아닙니다.
                                                </label>
                                            </li>
                                            <li>
                                                <label for="qna1_2">
                                                    <input type="radio" name="qna1" id="qna1_2" value="한번 보고 알기 어려워요." v-model="feedbackForm.how_about_dating">
                                                    <span class="radio-icon"></span>
                                                    2. 한번 보고 알기 어려워요.
                                                </label>
                                            </li>
                                            <li>
                                                <label for="qna1_3">
                                                    <input type="radio" name="qna1" id="qna1_3" value="호감 있습니다." v-model="feedbackForm.how_about_dating">
                                                    <span class="radio-icon"></span>
                                                    3. 호감 있습니다.
                                                </label>
                                            </li>
                                            <li>
                                                <label for="qna1_4">
                                                    <input type="radio" name="qna1" id="qna1_4" value="이상형이었습니다." v-model="feedbackForm.how_about_dating">
                                                    <span class="radio-icon"></span>
                                                    4. 이상형이었습니다.
                                                </label>
                                            </li>
                                        </ul>

                                        <div class="m-input-error">{{feedbackForm.errors.how_about_dating}}</div>
                                    </li>
                                    <li>
                                        <div class="qs">
                                            <p class="num">2</p>
                                            <p class="txt">
                                                애프터 만남 하고 싶으신가요?
                                            </p>
                                        </div>
                                        <ul class="as row-group">
                                            <li>
                                                <label for="qna2_1">
                                                    <input type="radio" name="qna2" id="qna2_1" value="네." v-model="feedbackForm.want_after">
                                                    <span class="radio-icon"></span>
                                                    1. 네
                                                </label>
                                            </li>
                                            <li>
                                                <label for="qna2_2">
                                                    <input type="radio" name="qna2" id="qna2_2" value="잘 모르겠어요."  v-model="feedbackForm.want_after">
                                                    <span class="radio-icon"></span>
                                                    2. 잘 모르겠어요.
                                                </label>
                                            </li>
                                            <li>
                                                <label for="qna2_3">
                                                    <input type="radio" name="qna2" id="qna2_3" value="아니요." v-model="feedbackForm.want_after">
                                                    <span class="radio-icon"></span>
                                                    3. 아니요.
                                                </label>
                                            </li>
                                        </ul>
                                        <div class="m-input-error">{{feedbackForm.errors.want_after}}</div>
                                    </li>
                                    <li>
                                        <div class="qs">
                                            <p class="num">3</p>
                                            <p class="txt">
                                                상대방의 호감도는 어떤가요?
                                            </p>
                                            <p class="sub-txt">
                                                소개팅 결과에 상관없이 본인이 느낀 호감도만 알려주세요. <br>
                                                추후 소개팅 매칭에 영향을 끼칩니다.
                                            </p>
                                        </div>
                                        <div class="as row-group">
                                            <div :class="`review-score-wrap col-group star${feedbackForm.likeablility}`">
                                                <div class="m-input-score">
                                                    <input type="radio" :value="1" id="likeablility-1" v-model="feedbackForm.likeablility">
                                                    <label for="likeablility-1"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="2" id="likeablility-2" v-model="feedbackForm.likeablility">
                                                    <label for="likeablility-2"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="3" id="likeablility-3" v-model="feedbackForm.likeablility">
                                                    <label for="likeablility-3"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="4" id="likeablility-4" v-model="feedbackForm.likeablility">
                                                    <label for="likeablility-4"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="5" id="likeablility-5" v-model="feedbackForm.likeablility">
                                                    <label for="likeablility-5"></label>
                                                </div>
                                            </div>
                                            <p class="score-result score-result-1" style="display: none;">
                                                <span class="score-num-1"></span>점
                                            </p>
                                        </div>

                                        <div class="m-input-error">{{feedbackForm.errors.likeablility}}</div>
                                    </li>
                                    <li>
                                        <div class="qs">
                                            <p class="num">4</p>
                                            <p class="txt">
                                                상대방의 매너는 어떤가요?
                                            </p>
                                            <p class="sub-txt">
                                                소개팅 결과에 상관없이 본인이 느낀 호감도만 알려주세요. <br>
                                                추후 소개팅 매칭에 영향을 끼칩니다.
                                            </p>
                                        </div>
                                        <div class="as row-group">
                                            <div  :class="`review-score-wrap col-group star${feedbackForm.manner}`">
                                                <div class="m-input-score">
                                                    <input type="radio" :value="1" id="manner-1" v-model="feedbackForm.manner">
                                                    <label for="manner-1"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="2" id="manner-2" v-model="feedbackForm.manner">
                                                    <label for="manner-2"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="3" id="manner-3" v-model="feedbackForm.manner">
                                                    <label for="manner-3"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="4" id="manner-4" v-model="feedbackForm.manner">
                                                    <label for="manner-4"></label>
                                                </div>
                                                <div class="m-input-score">
                                                    <input type="radio" :value="5" id="manner-5" v-model="feedbackForm.manner">
                                                    <label for="manner-5"></label>
                                                </div>
                                            </div>
                                            <p class="score-result score-result-2" style="display: none;">
                                                <span class="score-num-2"></span>점
                                            </p>
                                        </div>
                                        <div class="m-input-error">{{feedbackForm.errors.manner}}</div>

                                    </li>
                                    <li>
                                        <div class="qs">
                                            <p class="num">5</p>
                                            <p class="txt">
                                                소개팅 장소는 어떠셨나요?
                                            </p>
                                        </div>
                                        <ul class="as row-group">
                                            <li>
                                                <label for="qna5_1">
                                                    <input type="radio" name="qna5" id="qna5_1" value="만족"  v-model="feedbackForm.how_about_place">
                                                    <span class="radio-icon"></span>
                                                    1. 만족
                                                </label>
                                            </li>
                                            <li>
                                                <label for="qna5_2">
                                                    <input type="radio" name="qna5" id="qna5_2" value="불만족" v-model="feedbackForm.how_about_place">
                                                    <span class="radio-icon"></span>
                                                    2. 불만족
                                                </label>
                                            </li>
                                        </ul>
                                        <div class="m-input-error">{{feedbackForm.errors.how_about_place}}</div>

                                    </li>
                                    <li>
                                        <div class="qs">
                                            <p class="num">6</p>
                                            <p class="txt">
                                                매니저에게 하고 싶은 말 남겨주세요.
                                            </p>
                                        </div>
                                        <div class="as">
                                            <textarea name="" id="" cols="30" rows="10" v-model="feedbackForm.comment"></textarea>
                                        </div>
                                    </li>
                                    <div class="m-input-error">{{feedbackForm.errors.comment}}</div>
                                </ul>
                            </form>
                        </div>
                        <button type="button" class="submit-btn" @click="storeFeedback(targetFeedbackDating)">후기 전송</button>
                    </div>
                    <!-- //소개팅 리뷰 -->
            </div>
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import Sidebar from "../../Components/Sidebar";
import InputCities from "../../Components/Form/InputCities";
import InputAddress from "../../Components/Form/InputAddress";

export default {
    components: {InputAddress, InputCities, Sidebar, Link, Pagination},
    data() {
        return {
            user: this.$page.props.user.data,
            datings: this.$page.props.datings,
            latestUnreadDating : this.$page.props.latestUnreadDating ? this.$page.props.latestUnreadDating.data : "",
            form: this.$inertia.form({
                page: 1,
                state: this.$page.props.state,
                type: "",
                check_address: "",

                // 일정제안
                city1: "",
                city2: "",
                area1: "",
                area2: "",
                schedule1: "",
                schedule2: "",
                schedule3: "",
                schedule4: "",
                schedule5: "",
                schedule6: "",
                schedule7: "",
                schedule8: "",
                schedule9: "",
                schedule10: "",

                // 장소제안
                address_name:"",
                address: "",
                place_url:"",
                place_name:"",
                scheduled_at:"",
            }),
            feedbackForm: this.$inertia.form({
                "dating_id" : "",
                "how_about_dating" : "",
                "want_after" : "",
                "likeablility" : "",
                "manner" : "",
                "how_about_place" : "",
                "comment" : "",
            }),
            targetDating: "",
            targetAddressDating: "", // 장소확인
            targetSuggestAddressDating: "", // 장소제안
            targetSuggestSchedule: "", // 일정제안
            targetFeedbackDating: '', // 피드백
            activeInputAddress: false,
            activeGuide: false,
            word:"",
            places: [],
            now: `${new Date().getFullYear()}-${new Date().getMonth() + 1}-${new Date().getDate() + 2}T00:00:00`
        }
    },
    methods: {
        read(dating){
            this.form.patch("/datings/" + dating.id + "/read", {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.datings = page.props.datings;
                    this.targetDating = "";
                    this.latestUnreadDating = "";
                    this.activeGuide = true;
                }
            })
        },

        partner(dating){
            if(this.user.sex === "남자")
                return dating.women;

            return dating.men;
        },

        filter(){
            this.form.get("/datings", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.datings = page.props.datings;
                }
            });
        },

        checkAddress(dating){
            this.form.type = "장소확인";
            this.form.check_address = 1;

            this.form.patch("/datings/" + dating.id, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.datings = page.props.datings;

                    this.targetAddressDating = "";
                }
            })
        },

        search(){
            axios.get("/api/search", {
                params: {
                    word: this.word
                }
            }).then(response => {
                let data = JSON.parse(response.data);

                if(data.documents.length === 0) {
                    alert("검색 결과가 없습니다. 직접 주소를 입력해주세요!");

                    return this.activeInputAddress = true;
                }

                this.places = data.documents;
            });
        },

        selectPlace(place){
            this.form.address_name = place.address_name;
            this.form.place_name = place.place_name;
            this.form.place_url = place.place_url;
        },

        alarmClass(dating){
            let name = "alarm-icon";

            if(dating.check_address)
                return name;

            if(this.user.sex === "여자"){
                if(dating.ongoing && !dating.check_address && dating.place_url)
                    return name + " active";

                if(dating.ongoing && !dating.city1)
                    return name + " active";
            }

            if(this.user.sex === "남자"){
                if(dating.ongoing && !dating.check_address && dating.city1)
                    return name + " active";

                if(!dating.check_address && dating.ongoing && dating.city1)
                    return name + " active";
            }

            return name;
        },

        /*selectPlace(place){
            this.form.address_name = place.address_name;
            this.form.place_name = place.place_name;
            this.form.place_url = place.place_url;
        },*/

        suggestAddress(dating){
            this.form.type = "장소제안";

            this.form.patch("/datings/" + dating.id, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.datings = page.props.datings;

                    this.targetSuggestAddressDating = "";
                }
            })
        },

        suggestSchedule(dating){
            this.form.type = "일정제안";

            this.form.patch("/datings/" + dating.id, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.datings = page.props.datings;

                    this.targetSuggestSchedule = "";
                }
            })
        },

        storeFeedback(dating){
            this.feedbackForm.dating_id = dating.id;

            this.feedbackForm.post("/feedbacks", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.datings = page.props.datings;

                    this.targetFeedbackDating = "";

                    this.feedbackForm = this.$inertia.form({
                        "dating_id" : "",
                        "how_about_dating" : "",
                        "want_after" : "",
                        "likeablility" : "",
                        "manner" : "",
                        "how_about_place" : "",
                        "comment" : "",
                    });

                }
            })
        }
    },
    computed: {

    },

    mounted() {

    }
}
</script>
