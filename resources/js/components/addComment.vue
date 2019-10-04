<template>
<div>
    <div class='form-group'>
        <input @keyup.enter='send(ppp)' type="text" v-model='comment' class="form-control" placeholder="Add new comment..." >
        <button @click='send(ppp)' class="btn btn-primary mt-2">Send</button>
    </div>

    <div v-for="com in coms">
        <small class="name">{{com.auther_name}} <small>{{com.created_at}}</small></small>
        <div>
            {{com.content}}
        </div>
        <hr style="background-color:#888;">
    </div>
</div>
</template>

<script>
    import Echo from "laravel-echo"
    window.Pusher = require('pusher-js');
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'abcdef',
        wsHost: window.location.hostname,
        wsPort: 6001,
        disableStats: true,
    });
    const D={
    mounted(){
        this.u=this.user;
        this.coms=this.comments;
        window.Echo.channel(`comment.${this.ppp}`).listen('addComment',e=>{
            this.coms.unshift(e);
        });
    },
    props:['comments','user','ppp'],
    data:function(){
        return{
            comment:null,
            u:null,
            coms:[],
        }
    },
    methods:{
        send(PID){
                if(this.comment === null)return;
                var info={user_id:this.u.id,auther_name:this.u.name,post_id:PID,content:this.comment};
                return axios.post(`/api/saveComm`,info).then(
                    response=>{
                        this.comment=null;
                    }
                ).catch(err=>{
                    console.log(err);
                });
            }
    }

};
    export default D;
</script>

<style>
</style>
