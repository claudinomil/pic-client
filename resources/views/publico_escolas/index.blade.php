<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> {{env('APP_NAME')}} | @yield('page_title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Claudino Mil Homens de Moraes" name="description" />
        <meta content="CMHM" name="author" />

        <!-- CSRF-TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('build/assets/images/image_favicon.png') }}">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @include('layouts.head-css')
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 pb-5">
                                <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Confirmar Operação"><i class="fa fa-save label-icon"></i> Confirmar</button>
                            </div>
                            <div class="col-12">
                                <form id="frm_publico_escolas" name="frm_publico_escolas">
                                    <div class="row">
                                        <div class="form-group col-12 pb-3">
                                            <label class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required="required">
                                        </div>
                                        <div class="form-group col-12 pb-3">
                                            <label class="form-label">Diretor</label>
                                            <input type="text" class="form-control" id="diretor" name="diretor" required="required">
                                        </div>
                                        <div class="form-group col-12 pb-3">
                                            <label class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="endereco" name="endereco" required="required">
                                        </div>
                                        <div class="form-group col-12 pb-3">
                                            <label class="form-label">Telefone</label>
                                            <input type="text" class="form-control mask_phone_with_ddd" id="telefone" name="telefone">
                                        </div>
                                        <div class="form-group col-12 pb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control mask_email" id="email" name="email">
                                        </div>
                                        <div class="form-group col-12 pb-3">
                                            <label class="form-label">Motivo</label>
                                            <textarea class="form-control" id="motivo" name="motivo"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- javascript -->
        @include('layouts.scripts')
    </body>
</html>
