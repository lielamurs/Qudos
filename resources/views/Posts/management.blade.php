<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .panel-body img {
            align-items: center;
            display: flex;
            justify-content: center;
            margin: auto;
        }

        .position-ref {
            position: relative;
        }

        .title > a{
            font-size: 84px;
            text-decoration: none;
            color: #636b6f;
            padding-right: 100%;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .panel-body{
            word-wrap: break-word;
            color: #111111;
        }

    </style>
</head>
<body>
<div class="top-left links">
    <div class="title">
        <a href="{{ url('/') }}">Qudos</a>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav links">
                <li><a href="{{route('news')}}">News</a></li>
                <li><a href="{{route('suggestions')}}">Suggestions</a></li>
                <li><a href="{{route('feedback')}}">Feedback</a></li>
                <li><a href="{{route('about')}}">About me</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @endauth
                        @endif
            </ul>
        </div>
    </nav>


        <div class="col-sm-8 posts-main">
            <strong>NEWS</strong>
            @foreach($news as $post)
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$post->title}}</div>

                                <div class="panel-body">
                                    <img src="uploads/{{$post->image}}"><br>

                                    <p>{{$post->content}}</p>
                                    <form class="form-horizontal" method="POST" action="{{ route('management.delete') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                                        <input type="hidden" value="{{ Auth::user()->id}}" name="user">

                                        <input type="hidden" value="{{ $post->id}}" name="post">

                                        <input type="hidden" value="news" name="type">

                                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    <div class="col-sm-8 posts-main">
        <strong>SUGGESTIONS</strong>
        @foreach($suggestions as $post)
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{$post->title}}</div>

                            <div class="panel-body">
                                <img src="uploads/{{$post->image}}"><br>

                                <p>{{$post->content}}</p>
                                <form class="form-horizontal" method="POST" action="{{ route('management.delete') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">

                                    <input type="hidden" value="{{ Auth::user()->id}}" name="user">

                                    <input type="hidden" value="{{ $post->id}}" name="post">

                                    <input type="hidden" value="suggestions" name="type">

                                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>

    <div class="col-sm-8 posts-main">
        <strong>FEEDBACK</strong>
        @foreach($feedbacks as $post)
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{$post->title}}</div>

                            <div class="panel-body">
                                <img src="uploads/{{$post->image}}"><br>

                                <p>{{$post->content}}</p>
                                <form class="form-horizontal" method="POST" action="{{ route('management.delete') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">

                                    <input type="hidden" value="{{ Auth::user()->id}}" name="user">

                                    <input type="hidden" value="{{ $post->id}}" name="post">

                                    <input type="hidden" value="feedback" name="type">

                                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>

</div>
</body>
</html>
