<template>
<div>
    <div class="container my-posts" v-for='p in posts'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><img :src="p.user.user_image" class="post-image"> <a :href="`/${p.user.id}`">{{p.user.name}} </a></div>
                    <div class="card-body">
                        {{p.content}}
                        <div class="post-gal">
                            <div class="image-contener" v-for="M in p.media">
                                <img :src="M.src">
                            </div>
                        </div>
                        <br><hr>
                        <div class="comment" v-if="p.LC">
                            <div class="header"><small>{{p.LC.auther_name}}</small> <small>{{p.LC.created_at}}</small></div>
                            <div class="comment-body">
                                {{p.LC.content}}
                            </div>
                            <hr>
                        </div>
                        <a :href="'/'+p.id+'/comments'">{{p.NOC}} comments...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data:function(){
            return {
                UD:JSON.parse(this.user),
                posts:null,
                error:null,
                comments:[],
            };
        },
        props:[
            'user','userposts',
        ],
        mounted:function(){
            var sendInfos= (this.userposts)?{'user_id':this.userposts}:{};
            axios.post('/api/posts/',sendInfos).then(
                response=>{
                    this.posts=response.data;
                    this.comments=this.posts.comments || [];
                    console.log(this.posts);
                }
                ,err=>{
                    this.error=err;
                }
            );

        },
        methods:{
        }
    }
</script>
<style scoped>
    .my-posts{
        margin-top: 20px;
    }
    .post-image{
        width: 60px;height: auto;
        border-radius: 100%;
    }
    .comment{
        margin-top: 20px;
        box-sizing: border-box;
        padding: 5px 15px 15px;
        border: solid 1px #ccc;
        border-radius: 7px;
    }
    .post-gal{
        width: 100%;
    }
    .post-gal::after{
        content: '';
        display: table;
        clear: both;
    }
    .image-contener{
        width:49%;
        float: left;
    }
    .image-contener img{
        width: 100%;
        height: auto;
    }
    @media only screen  and (max-width:500px){
        
    }
</style>
