<template>
  <div>
      <form enctype="multipart/form-data" @submit="uploadFile" ref="FD">
        <label for="file" class="button-wrapper">
            <span>choose an image</span> 
            <input type="file" name="img" id="userImage" ref="uploadIMG" @change="$refs.sBtn.click()"><br>
            <button style="display:none;" type="submit" ref="sBtn"></button>
        </label>
      </form>
  </div>
</template>

<script>
export default {
    mounted(){
    },
    data:()=>{
        return{
            myImage:null,
        }
    }
    ,
    props:['user'],
    methods:{
        uploadFile:function(e){
            e.preventDefault();
            const formData=new FormData(this.$refs.FD);
            const config = {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress:info=>{
                }
            }
            axios.post(`/api/user/${this.user}`,formData,config).then(res=>{
                console.log(res.data);
            },err=>{
                console.log(err);
            });
        }
    }
}
</script>

<style scoped>
    .button-wrapper {
        position: relative;
        width: 150px;
        text-align: center;
        margin: 20% auto;
    }
    .button-wrapper span {
        position: relative;
        z-index: 0;
        display: inline-block;
        width: 100%;
        background: #00bfff;
        cursor: pointer;
        color: #fff;
        padding: 10px 0;
        text-transform:uppercase;
        font-size:12px;
    }
    #userImage{
        display: inline-block;
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 50px;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
</style>