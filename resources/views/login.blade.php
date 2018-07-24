<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="google-site-verification" content="ec3ULarkIZ_AJsP5MGvBcrA_oBdlbDkgPqlxKBZ2j2c" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
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

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
            <div class="flex-center position-ref full-height">
            {!! Form::open(['url' => 'signin']) !!}
            <input type="text" name="email"  class="for-data">
             <input type="password" name="password"  class="for-data">
             <button type="submit">Login</button>
            
            {!! Form::close() !!}
            <div class="content">
                <div class="title m-b-md">
                  {{env('APP_NAME')}}
                </div>
                <button><a href="{{ url('/auth/google') }}">google login</a></button>
              <a href="{{ url('/auth/github') }}" class="btn btn-github"><i class="fa fa-github"></i> Github</a>
            <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
            <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
            <a href="{{ url('yahoo-login') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Yahoo</a>

                
            </div>
        </div>
    </body>
</html>
