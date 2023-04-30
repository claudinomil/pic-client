<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> {{env('APP_NAME')}} | @yield('page_title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('build/assets/images/image_favicon.png') }}" id="appFavicon">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('build/assets/images/image_favicon.png') }}" id="appFavicon">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @include('mobile.layouts.styles')
    </head>
    <body style="background-color: #2a3042;">
        <div class="container">
            <div class="row">
                <div class="navbar-header bg-dark bg-gradient" style="position:fixed; z-index: 999;">
                    <div class="px-4" id="divLogoTopoPrincipal">
                        <span class="logo-lg">
                            <img src="{{ asset('build/assets/images/image_logo_layout_light_menu.png') }}" alt="" width="150">
                        </span>
                    </div>
                    <div class="" id="divLogoTopoReturn" style="display: none;">
                        <a href="#" onclick="window.location='{{route('mobile.index')}}'">
                            <i class="fa fa-arrow-left text-white font-size-12 px-2 py-2"></i>
                            <span class="logo-lg">
                                <img src="{{ asset('build/assets/images/image_logo_layout_light_menu_min.png') }}" alt="" width="72">
                            </span>
                        </a>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <!-- Chat -->
                            <a href="#" class="text-white" onclick="alert('Chat em desenvolvimento.')"><i class="bx bx-chat font-size-22 align-middle me-1"></i></a>

                            <!-- Opções -->
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ isset($userLoggedData['avatar']) ? asset($userLoggedData['avatar']) : asset('build/assets/images/users/avatar-0.png') }}" alt="Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst($userLoggedData['name'])}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target=".modal-profile" onclick="userProfileData(2,{{$userLoggedData['id']}});"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Perfil</span></a>

                                <div class="dropdown-divider"></div>

                                @foreach ($userLoggedMenuSubmodulosMobile as $key => $dado)
                                    <a href="#" class="dropdown-item" href="#" onclick="window.location='{{route($dado['menu_route'].'.index')}}'"><i class="{{$dado['menu_icon']}} font-size-16 align-middle me-1"></i> <span>{{$dado['menu_text']}}</span></a>
                                @endforeach

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-2" style="margin-top: 70px;">
{{--                <div class="col-3 text-center"><img src="{{ asset('build/assets/images/pictograma_1.png') }}" width="50"></div>--}}
{{--                <div class="col-3 text-center"><img src="{{ asset('build/assets/images/pictograma_2.png') }}" width="50"></div>--}}
{{--                <div class="col-3 text-center"><img src="{{ asset('build/assets/images/pictograma_5.png') }}" width="50"></div>--}}
{{--                <div class="col-3 text-center"><img src="{{ asset('build/assets/images/pictograma_7.png') }}" width="50"></div>--}}
            </div>
            <div class="row" style="margin-bottom: 70px;">
                <div class="col-12 py-2">
                    <div class="text-light text-center pb-2" id="divTitulo"></div>
                    @yield('content')
                </div>
            </div>
            <div class="footer">
                <div class="col-12 text-center"><script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}.</div>
                <div class="col-12 text-center">Design & Develop by Claudino Mil</div>
            </div>
        </div>

        @include('layouts.modals')

        <!-- javascript -->
        @include('mobile.layouts.scripts')
        @include('layouts.scripts-profile')
    </body>
</html>
