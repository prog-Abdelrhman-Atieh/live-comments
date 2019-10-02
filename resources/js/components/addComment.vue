<template>
<div>
    <div class='form-group'>
        <input @keyup.enter='send(postID)' type="text" v-model='comment' class="form-control" placeholder="Add new comment..." >
        <button @click='send(postID)' class="btn btn-primary mt-2">Send</button>
    </div>
    <div v-for="com in coms">
        <small class="name">{{com.auther_name}}</small>
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
        this.u=JSON.parse(this.user);
        this.coms=this.comments;
        window.Echo.channel('comment').listen('addComment',e=>{
            if(this.postID == e.message.post_id)
                this.coms.unshift(e.message);
        });
    },
    props:['postID','comments','user'],
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
                axios.post(`api/saveComm`,{user_id:this.u.id,auther_name:this.u.name,post_id:PID,content:this.comment}).then(
                    response=>{
                        //console.log(response.data);
                        this.comment=null;
                    },
                    err=>{
                        console.log(err);
                    }
                );
            }
    }

};
    export default D;
</script>

<style>
</style>
