<template>
    <div>
        <div class="new-post-alert" >
            you have new posts
        </div>
        <add-post :user_id='user_id'></add-post>
        <my-posts :user='user'></my-posts>
    </div>
</template>
<script>
    const mainC={
    mounted(){
    },
    props:['user_id','user'],
    data:function(){
        return {
            newPosts:['new'],
        }
    },
    methods:{
    }

};
    export default mainC;
</script>
<style>
    
</style>