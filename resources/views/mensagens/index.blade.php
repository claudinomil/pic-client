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
                            <div class="heading-avatar-icon">
                                <img src="{{$usuario_logado['avatar']}}">
                            </div>
                        </div>
                        <div class="col-sm-7 col-xs-7 heading-dot pull-right">
                            <span>{{$usuario_logado['name']}}</span>
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
{{--                    <div class="row newMessage-heading">--}}
{{--                        <div class="row newMessage-main">--}}
{{--                            <div class="col-sm-2 col-xs-2 newMessage-back" id="mensagensNovaConversaFechar">--}}
{{--                                <i class="fa fa-arrow-left"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-10 col-xs-10">--}}
{{--                                <img src="{{ asset('build/assets/images/image_logo_chat.png') }}" class="col-12" width="100%">--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-xs-12 text-center font-size-22">Nova conversa</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row composeBox">
                        <div class="col-sm-12 composeBox-inner">
                            <div class="form-group">
                                <input id="mensagensProcurarNovaConversa" type="text" class="form-control" name="mensagensProcurarNovaConversa" placeholder="Procurar nova conversa">
                            </div>
                        </div>
                    </div>
                    <div class="row compose-sideBar" id="mensagensNovasConversas">
                        @foreach($novas_conversas as $dado)
                            @php
                                $id = $dado['id'];
                                $avatar = $dado['avatar'];
                                $name = $dado['name'];
                            @endphp

                            <div class="row sideBar-body mensagens_filtrar_novas_conversas" onclick="mensagens_montar_destinatario(3, '{{$id}}', '{{$avatar}}', '{{$name}}');" data-filtro="{{$name}}">
                                <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                    <div class="avatar-icon">
                                        <img src="{{$avatar}}">
                                    </div>
                                </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8 sideBar-name">
                                            <span class="name-meta">{{$name}}</span>
                                            <br>
                                            <span class="text-muted small">&nbsp;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-8 conversation">
                <div class="row heading">
                    <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon" id="mensagensDestinatarioFoto">
                            <img src="">
                        </div>
                    </div>
                    <div class="col-sm-7 col-xs-7 heading-name" id="mensagensDestinatarioDescricao">
                        <div class="heading-name-meta descricao_nome">&nbsp;</div>
                        <span class="heading-online descricao_online">&nbsp;</span>
                    </div>
                    <div class="col-sm-2 col-xs-2 heading-dot pull-right">&nbsp;</div>
                    <div class="col-sm-1 col-xs-1 heading-dot pull-right">
{{--                        <i class="fa fa-ellipsis-v fa-2x pull-right dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-hidden="true"></i>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                            <li><a class="dropdown-item" href="#" id="mensagensEncerrar">Sair</a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
                <div class="row message" id="mensagensConversas">
                    {{--                                <div class="row message-previous">--}}
                    {{--                                    <div class="col-sm-12 previous">--}}
                    {{--                                        <a onclick="previous(this)" id="ankitjain28" name="20">--}}
                    {{--                                            Show Previous Message!--}}
                    {{--                                        </a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                </div>


                <form method="post" id="frm_mensagens_enviadas">
                    @csrf
                    @method('POST')

                    <input type="hiddenx" id="remetente_user_id" name="remetente_user_id" value="{{$usuario_logado['id']}}">
                    <input type="hiddenx" id="destinatario_user_id" name="destinatario_user_id" value="0">
                    <input type="hiddenx" id="mensagem" name="mensagem" value="">

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
