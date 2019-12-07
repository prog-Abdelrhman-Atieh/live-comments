<template>
<div>
    <div :class='(newPostsAdded)?"new-Posts show":"new-Posts hide"' ref="newPosts" @click='refresh()'>&clubs; {{newPostsAdded}} new Post</div>
    <div class="container my-posts" v-for='p in posts'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><img :src="p.user.user_image" class="post-image"> <a :href="`/${p.user.id}`">{{p.user.name}} </a></div>
                    <div class="card-body">
                        {{p.content}}
                        <div class="post-gal">
                            <div class="image-contener" v-for="M in p.media" :style="'width:'+(100/p.media.length-1)+'%;'" v-html="addMedia(M.src)">
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
    import Echo from "laravel-echo"
    window.Pusher = require('pusher-js');
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'ABCDEF',
        wsHost: window.location.hostname,
        wsPort: 6001,
        disableStats: true,
    });
    export default {
        data:function(){
            return {
                UD:JSON.parse(this.user),
                posts:null,
                error:null,
                comments:[],
                newPostsAdded:0,
            };
        },
        props:[
            'user','userposts',
        ],
        mounted:function(){
            window.Echo.channel(`newMessage`).listen('newPostCheck',e=>{
                this.newPostsAdded++;
            });
            var sendInfos= (this.userposts)?{'user_id':this.userposts}:{};
            axios.post('/api/posts/',sendInfos).then(
                response=>{
                    this.posts=response.data;
                    this.comments=this.posts.comments || [];
                }
                ,err=>{
                    this.error=err;
                }
            );
        },
        methods:{
            refresh(){
                const NPA=this.newPostsAdded;
                this.newPostsAdded=0;
                axios.post('/api/newPosts',{newPostsAdded:NPA}).then(
                    response=>{
                        this.posts.unshift(...response.data);
                        window.scrollTo(0,0);
                    }
                );
            },
            addMedia(m){
                var slices=m.split('.'),holder;
                window.mainInit.videos.forEach(element => {
                    if(element == slices[slices.length-1]){
                        holder=`<video width='100%' height='auto' src='${m}' controls ></video>`;
                    }
                });
                return holder || `<img width='100%' height='auto' src='${m}'>`;
            }
        }
    }
</script>
<style scoped>/*----------------------------*/
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
        float: left;
    }
    .image-contener embed{
        width: 100%;
        height: auto;
    }
    .new-Posts{
        position: fixed;
        top: 5px;left: 50%;
        transform: translate(-50%,-150%);
        padding: 15px;
        background-color:#07f;
        border-radius: 15px;
        color:#fff;
        cursor: pointer;
        z-index: 10;
    }
    .hide{
        animation: hide 1.5s forwards;
    }
    .show{
        animation: show 1.5s forwards;
    }
    @keyframes hide {
        from{
            transform: translateY(0);
        }
        to{
            transform: translateY(-150%);
        }
    }
    @keyframes show {
        from{
            transform: translateY(-150%);
        }
        to{
            transform: translateY(0);
        }
    }
    /*@media only screen  and (max-width:500px){
        
    }*/
</style>
