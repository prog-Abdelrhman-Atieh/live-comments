@extends('layouts.userShow')
@section('content')
    <div class="side-bar">
        <div class="image">
            <img src="{{asset($user->user_image)}}" alt="user image" class="user-image" onclick="document.getElementById('id01').style.display='block'">
        </div>
        <div class="image-info">
            <span> {{$user->name}}</span>
        </div>
        <div class="image-info">
            <span> {{$user->email}}</span>
        </div>
        <div class="image-info">
            <span> {{$user->created_at}}</span>
        </div>
        @if (Auth::user()->id === $user->id)
            <form id='updateImage' action="/user/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <input type="file" name="image" >
                <button>Change</button>
                <div class="err">{{$errors->first('image')}}</div>
                @csrf
            </form>
        @endif
    </div>
    <div class="main-content">
        <my-posts user='{{Auth::user()}}' userposts='{{$user->id}}'></my-posts>
    </div>
    <!-- ////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////// -->
    <div id="id01" class="modal animate">
        <img src="{{$user->user_image}}" class="show-image">
        <div class="exit" onclick="document.getElementById('id01').style.display='none'">&nbsp;</div>
    </div>
    <script>
        
    </script>
@endsection
@section('style')
    <style>
        .user-image{
            width: 300px;
            height: auto;
            border-radius: 100%;
        }
        .side-bar{
            width: 23vw;
            height: 100vh;
            position: fixed;
            float: left;
        }
        .image-info , .image{
            text-align: center;
        }
        .err{
            color: #f00;
        }
        /*-----------------------------------------------------------*/
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: hidden; 
            padding-top: 60px;
        }
        .show-image{
            width:50vw;
            height: auto;
            display: block;
            margin: 0 auto;
            z-index: 2;
        }
        .exit{
            position: absolute;top: 0;left: 0;
            width: 100%;height: 100%;
            background-color: rgba(0,0,0,0.4);
            z-index: -1;
        }
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)} 
            to {-webkit-transform: scale(1)}
        }
        
        @keyframes animatezoom {
            from {transform: scale(0)} 
            to {transform: scale(1)}
        }
    </style>
@endsection