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
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>


{{HTML::script('backend/bower_components/jquery-ui/js/jquery-ui.min.js')}}
{{HTML::script('backend/bower_components/popper.js/js/popper.min.js')}}
{{HTML::script('backend/bower_components/bootstrap/js/bootstrap.min.js')}}
  <!-- j-pro js -->

  {{HTML::script('backend/assets/pages/j-pro/js/jquery.maskedinput.min.js')}}
   {{HTML::script('backend/assets/pages/j-pro/js/jquery.j-pro.js')}}
      {{HTML::script('backend/bower_components/switchery/js/switchery.min.js')}}
<!-- jquery slimscroll js -->
{{HTML::script('backend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}
<!-- modernizr js -->
{{HTML::script('backend/bower_components/modernizr/js/modernizr.js')}}
<!-- am chart -->
{{HTML::script('backend/assets/pages/widget/amchart/amcharts.min.js')}}
{{HTML::script('backend/assets/pages/widget/amchart/serial.min.js')}}
<!-- Chart js -->
{{HTML::script('backend/bower_components/chart.js/js/Chart.js')}}
<!-- Todo js -->
{{HTML::script('backend/assets/pages/todo/todo.js')}}
<!-- i18next.min.js -->
{{HTML::script('backend/bower_components/i18next/js/i18next.min.js')}}
{{HTML::script('backend/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}
{{HTML::script('backend/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}
{{HTML::script('backend/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}
<!-- Custom js -->
{{HTML::script('backend/assets/pages/dashboard/custom-dashboard.min.js')}}
{{HTML::script('backend/assets/js/SmoothScroll.js')}}
{{HTML::script('backend/assets/js/pcoded.min.js')}}
{{HTML::script('backend/assets/js/demo-12.js')}}
{{HTML::script('backend/assets/js/jquery.mCustomScrollbar.concat.min.js')}}
{{HTML::script('backend/assets/js/script.min.js')}}
     <!-- Custom js -->

   {{HTML::script('backend/assets/pages/j-pro/js/custom/booking-comment.js')}}
      {{HTML::script('backend/assets/pages/j-pro/js/custom/form-comment.js')}}
{{--   Custom JS
 --}} 
 {{HTML::script('backend/js/custom.js')}}