<template>
    <div >
        <div class="main">
            <div class="form">
                <textarea name="content" class="content" rows="5" placeholder="Write something !!!" @keydown.enter="addP()" v-model="postContent"></textarea>
            </div>
            <div class="submit">
                <button @click="addP()" class="button">Share</button>
                <button @click="$refs.storage.style.display='block';showStorage()" class="button">Add media</button>
            </div>
            <hr style="background-color:#000;">
        </div>
        <div class="storage" ref='storage'>
            <div class="main-storage">
                <div class="storage-controllers">
                    <div class="s-exit left">
                        <button class="btn-danger" @click="$refs.storage.style.display='none'">X</button>
                    </div>
                    <div class="s-add right">
                        <input type="file" name="file" id="userImage" style="display:none;" ref="fileUpload" @change="addFile" multiple><br>
                        <button class="btn" @click="$refs.fileUpload.click()">Add file</button>
                    </div>
                </div>
                 <div class="s-loading">
                        <svg ref="loading" version="1.1" id="L3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <circle fill="none" stroke="#09f" stroke-width="4" cx="50" cy="50" r="44" style="opacity:0.5;"/>
                            <circle fill="#09f" stroke="#00f" stroke-width="3" cx="8" cy="54" r="6" >
                                <animateTransform
                                attributeName="transform"
                                dur="2s"
                                type="rotate"
                                from="0 50 48"
                                to="360 50 52"
                                repeatCount="indefinite" />
                                
                            </circle>
                        </svg>
                    </div>
                <div class="media-contener">
                    <div class="media" v-for="m in media">
                        <div class="selector" @click="select"></div>
                        <embed ref="mediaHolder"  :src="(m.split('public')[1])?'storage'+m.split('public')[1]:'storage/'+m.split('public')[0]" muted >
                        <span class="selected-mark">&#10003;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const newPost={
    mounted(){
    },
    props:['user_id'],
    data:function(){
        return {
            postContent:null,
            media:[],
            selected:[],
        }
    },
    methods:{
        addP(){
            if(this.comment === null)return;
                var info={content:this.postContent,media:this.selected};
                return axios.post(`/api/addPost/${this.user_id}`,info).then(
                    response=>{
                        this.postContent=null;
                        console.log('done',response.data);
                    }
                ).catch(err=>{
                    console.log(err);
                });
        },
        showStorage(){
            axios.get(`/api/getMidea/${this.user_id}`).then(
                    response=>{
                        this.media=response.data;
                        //setTimeout(()=>{
                            //this.$refs.mediaHolder.forEach(element => {
                            //    //element.play=false;
                            //    console.log(element);
                            //});
                        //    },200);
                    }
                ).catch(err=>{
                    console.log(err);
                });
        },
        addFile(){
            var formData=new FormData();
            formData.append('UF',this.$refs.fileUpload.files[0]);
            const config = {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress:info=>{
                    this.$refs.loading.style.display='block';
                }
            }
            axios.post(`/api/files/${this.user_id}`,formData,config).then(response=>{
                this.media.push(response.data);
                this.$refs.loading.style.display='none';
            },err=>{
                this.$refs.loading.style.display='none';
                console.log(err);
            });
        },
        select(e){
            var counter=-1,
                ele=this.selected.find(function(element){
                    counter++;
                    return element == e.target.parentElement.children[1].src;
                });
            if(ele != undefined){
                this.selected.splice(counter,1);
                e.target.parentElement.children[2].style.display='none';
            }
            else{
                this.selected.push(e.target.parentElement.children[1].src);
                e.target.parentElement.children[2].style.display='inline-block';
            }
        }
    }

};
    export default newPost;
</script>
<style scoped>
    .main{
        width: 730px;
        margin: 0 auto;
    }
    .form{
        width: 100%;
    }
    .form>.content{
        width: 100%;
        resize: none;
        scroll-behavior: smooth;
        border:none;
        border-bottom: 1px solid #ccc;
    }
    .button{
        background-color: #07f;
        border:none;
        display: inline-block;
        border-radius: 10px;
        padding: 10px 15px;
        color: #fff;
        font-weight:bold;
    }
    .storage{
        position: absolute;top: 50%;left: 50%;
        transform: translate(-50%,-50%);
        background-color: #fff;
        z-index: 1;
        overflow: visible;
        display: none;
    }
    .main-storage{
        position: relative;
        overflow: visible;
    }
    .media-contener{
        min-width: 70vw;
        max-height: 70vh;
        min-height: 70px;
        border: solid 1px #aaa;
        overflow-y: scroll;
    }
    .selector{
        position: absolute;
        top: 0;left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
        background-color: transparent;
        cursor: pointer;
        content: '';
    }
    .s-loading{
        position: absolute;
        top: 50%;left: 50%;
        transform: translate(-50%,-50%);
        z-index: 1;
    }
    div.media {
        margin: 5px;
        border: 1px solid #ccc;
        float: left;
        width: 200px;
        position: relative;
    }
    div.media:hover {
        border: 1px solid #777;
    }
    div.media embed {
        width: 100%;
        height: auto;
    }
    .storage-controllers{
        position: absolute;
        top: 0;left: 0;
        transform: translate(0,-100%);
        width: 100%;
        max-width:300px; 
    }
    .storage-controllers .right{
        float: right;
    }
    .storage-controllers .left{
        float: left;
    }
    .btn{
        background-color: #07f;
        color: #fff;
    }
    .selected-mark{
        background-color: #09f;
        border-radius: 100%;
        position: absolute;
        color: #fff;
        font-size: 20px;
        display: none;
    }
    svg{
        width: 100px;
        height: 100px;
        margin: 20px;
        display:none;
    }
    @media only screen and (max-width: 701px) {
        .main{
            width: 100%;
        }
        .storage{
            width: 50vh;
        }
        div.media {
        width: 125px;
    }
    }
</style>