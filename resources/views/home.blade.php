@extends('layouts.app')

@section('content')
<div id="main">
    <add-post user_id='{{Auth::user()->id}}'></add-post>
    <my-posts user='{{Auth::user()}}' ></my-posts>
</div>
@endsection
