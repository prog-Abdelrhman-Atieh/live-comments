<template>
<div>
    <div class="container my-posts" v-for='p in posts'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{p.user.name}} <small>{{p.user.email}}</small></div>
                    <div class="card-body">
                        {{p.content}}
                        <br>
                        <a :href="'/'+p.id+'/comments'">Show all comments...</a>
                        <add-comment :postID='p.id' :comments='p.comments' :user='user'></add-comment>
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
</style>
