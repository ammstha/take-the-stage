{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--<meta charset="utf-8">--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--<title>Laravel</title>--}}

{{--<!-- Fonts -->--}}
{{--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">--}}

{{--<!-- Styles -->--}}
{{--<style>--}}
{{--html, body {--}}
{{--background-color: #fff;--}}
{{--color: #636b6f;--}}
{{--font-family: 'Nunito', sans-serif;--}}
{{--font-weight: 200;--}}
{{--height: 100vh;--}}
{{--margin: 0;--}}
{{--}--}}

{{--.full-height {--}}
{{--height: 100vh;--}}
{{--}--}}

{{--.flex-center {--}}
{{--align-items: center;--}}
{{--display: flex;--}}
{{--justify-content: center;--}}
{{--}--}}

{{--.position-ref {--}}
{{--position: relative;--}}
{{--}--}}

{{--.top-right {--}}
{{--position: absolute;--}}
{{--right: 10px;--}}
{{--top: 18px;--}}
{{--}--}}

{{--.content {--}}
{{--text-align: center;--}}
{{--}--}}

{{--.title {--}}
{{--font-size: 84px;--}}
{{--}--}}

{{--.links > a {--}}
{{--color: #636b6f;--}}
{{--padding: 0 25px;--}}
{{--font-size: 13px;--}}
{{--font-weight: 600;--}}
{{--letter-spacing: .1rem;--}}
{{--text-decoration: none;--}}
{{--text-transform: uppercase;--}}
{{--}--}}

{{--.m-b-md {--}}
{{--margin-bottom: 30px;--}}
{{--}--}}
{{--</style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="flex-center position-ref full-height">--}}
{{--@if (Route::has('login'))--}}
{{--<div class="top-right links">--}}
{{--@auth--}}
{{--<a href="{{ url('/home') }}">Home</a>--}}
{{--@else--}}
{{--<a href="{{ route('login') }}">Login</a>--}}

{{--@if (Route::has('register'))--}}
{{--<a href="{{ route('register') }}">Register</a>--}}
{{--@endif--}}
{{--@endauth--}}
{{--</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}

        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}"><span class="glyphicon glyphicon-log-in"></span> Home</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>
                                    Login</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>
                                        Sign Up</a></li>
                            @endif
                            @endauth
                        @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col d-4 col-md-offset-4">
            <h2>Competition Date</h2>
            @foreach($competitionDetails as $competitionDetail)
                <p> Start Date:{{$competitionDetail->start_date}}</p>
                <p> End Date:{{$competitionDetail->endt_date}}</p>
                <p> Rebate Date:{{$competitionDetail->rebate_date}}</p>
                <p> Date:{{$competitionDetail->last_date_to_register}}</p>
                {{--<p> No of Compititer:{{$competitionDetail->no_of_competition}}</p>--}}
                <hr>

            @endforeach


        </div>
    </div>
</div>

</body>
</html>


