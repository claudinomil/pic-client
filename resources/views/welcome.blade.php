<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> Bem vindo | {{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('layouts.head-css')
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 text-center pt-5">
                    <img src="{{ asset('build/assets/images/image_logo_pic.png') }}" width="500">
                </div>
            </div>
        </div>
    </body>
</html>
