<template>
    <div >
        <div class="main">
            <div class="form">
                <textarea name="content" class="content" rows="5" placeholder="Write something !!!" @keydown.enter="addP()" v-model="postContent"></textarea>
            </div>
            <div class="submit">
                <button @click="addP()" class="button">Share</button>
            </div>
            <hr style="background-color:#000;">
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
        }
    },
    methods:{
        addP(){
            if(this.comment === null)return;
                var info={content:this.postContent};
                return axios.post(`/api/addPost/${this.user_id}`,info).then(
                    response=>{
                        this.postContent=null;
                        console.log('done');
                    }
                ).catch(err=>{
                    console.log(err);
                });
        },
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
</style>