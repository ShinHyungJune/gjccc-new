<template>
    <div class="upload">
        <label :for="id" class="find-file">
            파일 선택
            <input type="file" :id="id" accept="image/*" @change="changeFile" multiple v-if="multiple">
            <input type="file" :id="id" accept="image/*" @change="changeFile" v-else>
        </label>

<!--        <ul class="upload-list col-group" style="margin-top:20px;" v-if="defaultFiles && files.length === 0">
            <li v-for="(file, index) in defaultFiles" :key="index">
                <div class="img-box">
                    <img :src="file.url" alt="">
                </div>
            </li>
        </ul>-->

        <ul class="upload-list col-group" style="margin-top:20px;">
            <li v-for="(file, index) in sortedFiles" :key="index">
                <div class="img-box">
                    <img :src="file.img ? file.img : ''" alt="" crossorigin="anonymous">
                </div>
                <button type="button" class="del" @click="remove(index)">
                    <i class="xi-close"></i>
                </button>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        "defaultFiles": {
            default() {
                return [];
            }
        },
        "multiple": {
            default() {
                return true;
            }
        },
        "id" : {
            default() {
                return "img";
            }
        }
    },

    data(){
        return {
            files: [],
            /*
            {
                file: "",
                img : ""
            }
            * */
        }
    },

    methods: {
        changeFile(event) {
            if(!this.multiple)
                this.files = [];

            Array.from(event.target.files).map(file => {
                this.files.push({
                    index: this.files.length,
                    file: file,
                    img: URL.createObjectURL(file)
                })
            })

            this.$emit("change", this.files.map(file => file.file));
        },

        remove(index){
            this.files = this.files.filter((img, indexData) => indexData != index);

            this.$emit("change", this.files.map(file => file.file));
        },

        getBlobFromUrl(myImageUrl){
            return new Promise((resolve, reject) => {
                let request = new XMLHttpRequest();
                request.open('GET', myImageUrl, true);
                request.responseType = 'blob';
                request.onload = () => {
                    resolve(request.response);
                };
                request.onerror = reject;
                request.send();
            })
        },

    },

    computed: {
        sortedFiles(){
            return this.files.sort((a,b) => a.index - b.index);
        }
    },

    mounted() {
        if(this.defaultFiles)
            this.defaultFiles.map(async (file, index) => {
                let blob;

                blob = await this.getBlobFromUrl(file.url);

                this.files.push({
                    index: index,
                    img: file.url,
                    file: new File([blob], file.name, {type: file.type})
                })
            });
    }

}
</script>
