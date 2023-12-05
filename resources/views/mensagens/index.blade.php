@extends('layouts.app')

@section('title') Mensagens @endsection

@section('css')
@endsection

@section('content')

    @component('components.breadcrumb')
@section('page_title') {{ \App\Facades\Breadcrumb::getCurrentPageTitle() }} @endsection
@endcomponent

<div id="crudTable">
    <div id="indexMensagens">
        <div class="row app-one">
            <div class="col-sm-4 side">
                <div class="side-onexxx">
                    <div class="row heading">
                        <div class="col-sm-2 col-xs-2 heading-avatar">
                            <div class="heading-avatar-icon" id="mensagensUserLogadoFoto">
                                <img src="">
                            </div>
                        </div>
                        <div class="col-sm-7 col-xs-7 heading-dot pull-right" id="mensagensUserLogadoDescricao">
                            <span class="descricao_nome"></span>
                        </div>
                        <div class="col-sm-2 col-xs-2 heading-compose pull-right viewUltimasConversas" title="Nova Conversa" id="mensagensNovaConversa">
                            <i class="far fa-comment fa-2x pull-right" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-2 col-xs-2 heading-compose pull-right viewNovasConversas" title="Últimas Conversas" id="mensagensNovaConversaFechar" style="display: none;">
                            <i class="fa fas fa-comments fa-2x pull-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="row searchBox viewUltimasConversas">
                        <div class="col-sm-12 searchBox-inner">
                            <div class="form-group">
                                <input id="mensagensProcurarConversa" type="text" class="form-control" name="mensagensProcurarConversa" placeholder="Procurar conversa">
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar viewUltimasConversas" id="mensagensUltimasConversas">&nbsp;</div>
                </div>
                <div class="side-twoxxx viewNovasConversas" style="display: none;">
                    <div class="row composeBox">
                        <div class="col-sm-12 composeBox-inner">
                            <div class="form-group">
                                <input id="mensagensProcurarNovaConversa" type="text" class="form-control" name="mensagensProcurarNovaConversa" placeholder="Procurar nova conversa">
                            </div>
                        </div>
                    </div>
                    <div class="row compose-sideBar" id="mensagensNovasConversas">&nbsp;</div>
                </div>
            </div>
            <div class="col-sm-8 conversation">
                <div class="row heading">
                    <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon" id="mensagensDestinatarioFoto">
                            <img src="">
                        </div>
                    </div>
                    <div class="col-sm-10 col-xs-10 heading-name" id="mensagensDestinatarioDescricao">
                        <div class="heading-name-meta descricao_nome">&nbsp;</div>
                        <span class="heading-online descricao_online">&nbsp;</span>
                    </div>
                </div>
                <div class="row message" id="mensagensConversas"></div>

                <form method="post" id="frm_mensagens">
                    @csrf
                    @method('POST')

                    <input type="hidden" id="remetente_user_id" name="remetente_user_id" value="0">
                    <input type="hidden" id="destinatario_user_id" name="destinatario_user_id" value="0">
                    <input type="hidden" id="mensagem" name="mensagem" value="">
                    <input type="hidden" id="opcao" name="opcao" value="0">

                    <div class="row reply">
                        <div class="col-sm-11 col-xs-11 reply-main">
                            <textarea class="form-control" rows="1" id="mensagensTextareaEnviarMensagem" name="mensagensTextareaEnviarMensagem"></textarea>
                        </div>
                        <div class="col-sm-1 col-xs-1 reply-send" id="mensagensButtonEnviarMensagem">
                            <i class="fas fa-location-arrow fa-2x" aria-hidden="true"></i>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('mensagens.form')
@endsection

@section('script')
    <!-- scripts_mensagens.js -->
    <script src="{{ Vite::asset('resources/assets_template/js/scripts_mensagens.js')}}"></script>
@endsection
