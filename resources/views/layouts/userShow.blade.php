<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$user->name}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- VUE APP -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- SCRIPT-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body{
                width: 100vw; padding: 0; margin:0;overflow-x: hidden;
            }
            .navbar{
                width: 100%;
                position: relative;
                margin: 0;
            }
            .navbar::after{
                content: "";
                clear: both;
                display: table;
            }
            .navbar>ul{
                float: right;
                list-style: none;
                padding: 0 20px;
                margin: 0;
            }
            .navbar>ul>.navbar-item{
                display: inline;
            }
            .navbar>ul>.navbar-item>a{
                display: inline-block;
                padding: 15px 25px;
                color: #666;
                text-decoration: none;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .navbar>.title{
                float: left;
                position: absolute; top: 50%;
                padding-left: 20px;
                transform: translateY(-50%);
            }
        </style>
        @yield('style')
    </head>
    <body>
        <div class="navbar">
            <ul>
                <li class="navbar-item">
                    <a href="{{ url('/home') }}" class="navbar-link">Home</a>
                </li>
            </ul>
        </div>
        <div class="content" id="main">
            @yield('content')
        </div>
    </body>
</html>
