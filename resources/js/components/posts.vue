<template>
<div>
    <div class="container my-posts" v-for='p in posts'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{p.user.name}} <small>{{p.user.email}}</small></div>
                    <div class="card-body">
                        {{p.content}}
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
        mounted:function(){console.log(this.post);
            axios.post('/api/posts/',{}).then(
                response=>{
                    this.posts=response.data;
                    this.comments=this.posts.comments || [];
                }
                ,err=>{
                    this.error=err;
                }
            );

        },
        props:[
            'user',
        ],
        methods:{
        }
    }
</script>
<style scoped>
    .my-posts{
        margin-top: 20px;
    }
    .comment{
        margin-top: 20px;
        box-sizing: border-box;
        padding: 5px 15px 15px;
        border: solid 1px #ccc;
        border-radius: 7px;
    }
</style>
