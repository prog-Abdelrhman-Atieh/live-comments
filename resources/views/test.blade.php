@extends('layouts.app')
@section('content')
    <form action="/api/newPosts" method="GET" >
        <input type="text" name="content" id="files">
        <button type="submit">UP</button>
    </form>
@endsection