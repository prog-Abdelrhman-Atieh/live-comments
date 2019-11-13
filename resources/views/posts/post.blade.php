@extends('layouts.app')
@section('content')
    <div class="container" id="main">
        <div class="row justify-content-center">
            <div>
            <button onclick='history.back()' class="btn btn-primary">back</button>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="/{{$post->user->id}}">{{$post->user->name}} <small>{{$post->user->email}}</small></a></div>
                    <div class="card-body">
                        {{$post->content}}
                        <br>
                        <add-comment :comments="{{$post->comments}}" :user="{{Auth::user()}}" ppp="{{$post->id}}"></add-comment>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
