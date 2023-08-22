<template>
    <div class="m-input-address">
        <div class="modal-address" id="modal-address">
            <button class="btn-close" @click="close"><i class="xi-close"></i></button>
            <div id="popup-wrap">
                <!-- 우편번호 API가 띄워질 공간 -->
            </div>
        </div>

        <div class="m-input-wrap m-input-withBtn">
            <div class="m-input-text">
                <input type="text" placeholder="주소" v-model="form[address]" :name="address" @change="change" disabled>
            </div>

            <button type="button" class="m-input-btn" id="find_address">
                우편번호 검색
            </button>
        </div>

        <div class="m-input-wrap" style="margin-top:8px;">
            <div class="m-input-text" v-if="!form[address]">
                <input type="text" placeholder="상세주소" v-model="form[address_detail]" :name="address_detail" id="address_detail" @change="change" disabled>
            </div>
            <div class="m-input-text" v-else>
                <input type="text" placeholder="상세주소" v-model="form[address_detail]" :name="address_detail" id="address_detail" @change="changeAddressDetail">
            </div>
        </div>

        <div class="m-input-wrap" style="display:none;">
            <div class="m-input-text">
                <input type="text" disabled placeholder="우편번호" v-model="form[address_zipcode]" :name="address_zipcode" id="address_zipcode" style="width:150px; margin-top:10px;" @change="change">
            </div>
        </div>
    </div>
</template>
<style>


.modal-address {
    position: fixed;
    z-index: 20000;
    left: 50%; top:50%;
    transform:translate(-50%, -50%);
    background-color: white;
    border:1px solid #ccc;
}
.popup-wrap {
    border: 1px solid #333;
}

.m-input-address {
    flex:auto;
}
.m-input-text {

}
.m-input-text input {
    height: 48px; width: 100%;
    padding: 0 24px;
    font-size: 16px;
    border: 1px solid #e4e4e4;
    border-radius:30px;
}
.m-input-withBtn {
    display:flex;
}
.m-input-withBtn .m-input-text {
    flex:auto;
}
.m-input-withBtn .m-input-btn {
    flex:0 0 auto;
    margin-left:10px;
    padding: 0 20px;
    font-size: 14px; font-weight: bold;     text-align: center;
    border: 1px solid #e4e4e4;
    border-radius:30px;
    transition: .3s;

}

.modal-address .btn-close {
    display: none;
    width:40px; height:40px;
    position:absolute; top:-60px; right:-60px;
    background-color:#fff; border:1px solid #e1e1e1;
}

@media screen and (max-width:768px) {
    #popup-wrap > div {
        width:340px !important;
    }

    .modal-address .btn-close {
        right:0;
    }
}
</style>
<script>
export default {
    props: {
        form: {
            default : {
                errors: {}
            }
        },
        address: {
            default: "address"
        },
        address_detail: {
            default: "address_detail"
        },
        address_zipcode: {
            default: "address_zipcode"
        },
        x: {
            default: "x"
        },
        y: {
            default: "y"
        },
        activated: false,
    },
    data(){
        return {
            active: false,
        }
    },

    methods: {
        change(e){
            e.preventDefault();

            // this.emit(e.target.name, e.target.value);
        },

        changeAddressDetail(e){
            e.preventDefault();

            this.$emit("changeAddressDetail", e.target.value);
        },

        emit(name, value){
            this.$emit("change", {
                name: name,
                value: value
            });
        },

        close(){
            document.querySelector("#popup-wrap").style.display = "none";
            document.querySelector(".btn-close").style.display = "none";
        },

        async getCoords(address){
            let self = this;
            var geocoder = new kakao.maps.services.Geocoder();

            geocoder.addressSearch(
                address,
                function (result, status) {
                    // 정상적으로 검색이 완료됐으면
                    if (status === kakao.maps.services.Status.OK) {
                        // self.emit(self.address, data.address);
                        // self.emit(self.address_zipcode, data.zonecode);

                        self.$emit("change", {
                            place_url : `https://map.kakao.com/?q=${result[0].address_name}`,
                            address: address,
                        });
                    }
                }
            );
        },
    },


    mounted() {

        kakao.maps.load();

        let self = this;

        const postcodeWrap = document.querySelector("#popup-wrap");
        const btnClose = document.querySelector(".btn-close");

        document.getElementById("find_address").addEventListener("click", function(){ //주소입력칸을 클릭하면
            postcodeWrap.style.display = "block";
            btnClose.style.display = "block";

            //카카오 지도 발생
            new daum.Postcode({
                oncomplete: function(data) { //선택시 입력값 세팅
                    document.getElementById("address_detail").focus(); // 주소 넣기

                    // self.emit(self.address, data.address);

                    self.getCoords(data.address);

                    postcodeWrap.style.display = "none";
                    btnClose.style.display = "none";
                },
                onclose:function(state) {
                    if(state === "COMPLETE_CLOSE") {
                        // 콜백함수를 실행하여 슬라이드 업 기능이 실행 완료후 작업을 진행한다.
                        offDaumZipAddress(function() {
                            postcodeWrap.style.display = "none";
                            btnClose.style.display = "none";
                        });
                    }
                }
            }).embed(postcodeWrap);
        });
    }
}
</script>
