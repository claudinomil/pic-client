@extends('layouts.app')

@section('title') Sobre o Produto Educacional @endsection

@section('css')
@endsection

@section('content')

    @component('components.breadcrumb')
@section('page_title') {{ \App\Facades\Breadcrumb::getCurrentPageTitle() }} @endsection
@endcomponent

<div id="crudTable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Botoes -->
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!-- Botões -->
                                <div class="col-12 col-md-8 pb-2">
                                    @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes))
                                        <!-- Botão Alterar Registro -->
                                        <button type="button" class="btn btn-primary waves-effect btn-label waves-light editRecord" data-bs-toggle="tooltip" data-bs-placement="top" data-id="1" title="Alterar Registro"><i class="fas fa-pencil-alt label-icon"></i> Alterar</button>
                                    @endif
                                </div>

                                <!-- Pesquisar no Banco -->
                                <div class="col-12 col-md-4 float-end">
                                    <div class="row">
                                        <div class="col-5 float-end px-1">&nbsp;</div>
                                        <div class="col-5 float-end px-1">&nbsp;</div>
                                        <div class="col-2 float-start ps-1">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3" id="divSobreProduto">{!! $registro['descricao'] !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('sobre_produto.form')
@endsection

@section('script')
    <!-- scripts_sobre_produto.js -->
    <script src="{{ Vite::asset('resources/assets_template/js/scripts_sobre_produto.js')}}"></script>
@endsection

@section('script-bottom')
@endsection
