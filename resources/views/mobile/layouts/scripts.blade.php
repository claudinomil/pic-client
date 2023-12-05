<!-- libs -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/main.js') }}"></script>

<!-- functions.js -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/functions.js') }}"></script>

{{--<!-- scripts_mensagens.js -->--}}
{{--<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/scripts_mensagens.js') }}"></script>--}}

<!-- scripts_profiles.js -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/scripts_profiles.js') }}"></script>

@yield('script')

@yield('script-bottom')
