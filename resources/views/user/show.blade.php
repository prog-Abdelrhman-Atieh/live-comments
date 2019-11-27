@extends('layouts.userShow')
@section('content')
    <div class="header fix">
        <div class="image">
            <img src="{{asset($user->user_image)}}" alt="user image" class="user-image" onclick="document.getElementById('id01').style.display='block'">
        </div>
        <div class="image-info">
            <span> {{$user->name}}</span>
            <span> {{$user->email}}</span>
            <span> {{$user->created_at}}</span>
        </div>
        <div class="image-info right">
            @if (Auth::user()->id === $user->id)
                <user-image user='{{Auth::user()->id}}'></user-image>
            @endif
        </div>
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
@endsection
@section('style')
    <style>
        .user-image{
            width: 150px;
            height: auto;
            border-radius: 100%;
        }
        .header{
            width: 70vw;
            min-width: 725px;
            margin: auto;
            position: relative;
        }
        .image-info , .image{
            float: left;
            margin-left: 20px;
        }
        .right{float: right;}
        .image-info span{
            display: block;
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
            max-width: 50vw;
            max-height: 100vh;
            display: block;
            margin: 0 auto;
            z-index: 2;
            position: absolute;
            top: 50%;left: 50%;
            transform: translate(-50%,-50%);
        }
        .exit{
            position: absolute;top: 0;left: 0;
            width: 100%;height: 100%;
            background-color: rgba(0,0,0,0.4);
            z-index: -1;
        }
        .btn{
            border: none;
            background-color: #08f;
            color: #fff;
            display: inline-block;
            padding: 10px 15px;
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
        .fix::after{
            content: '';
            display: table;
            clear: both;
        }
        @media screen and (max-width: 724px) {
            .header{
                width: 100vw;
            }
            .image-info , .image{
                float: left;
                margin-left: 20px;
            }
        }
        @media screen and (max-width: 510px) {
            .header{
                width: 100vw;
            }
            .image-info:nth-last-child(1){
                clear: both;
            }
        }
    </style>
@endsection