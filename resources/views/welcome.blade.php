<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> {{env('APP_NAME')}} | Bem vindo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('layouts.head-css')
    </head>
    <body style="background-color: #2a3042;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center pt-5">
                    <img src="{{ asset('build/assets/images/image_logo_pic.png') }}" width="300">
                </div>

                <form id="frm_login" method="get" action="{{ route('login') }}">
                    @csrf

                    <div class="col-12 pt-5">
                        <h1 class="text-center">
                            <a class="text-success" href="javascript:frm_login.submit()">Login</a>
                        </h1>
                    </div>
                </form>

            </div>
        </div>
    </body>
</html>
