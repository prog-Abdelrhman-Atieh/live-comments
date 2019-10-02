@extends('layouts.app')

@section('content')
<div id="main">
    <my-posts user='{{Auth::user()}}' ></my-posts>
</div>
@endsection
