function chat_usuario_logado() {
    $.get("chat/usuario_logado", function (data) {
        if (data.success) {
            $("#chatUserLogadoFoto img").attr('src', data.success.avatar);
            $("#chatUserLogadoDescricao .descricao_nome").html(data.success.name);

            $("#remetente_user_id").val(data.success.id);
        } else {
            alert('Não encontrou o usuário logado');
        }
    });
}

//Montar Usuários Conversas
function chat_montar_ultimas_conversas() {
    chat_ultimas_conversas();
    $("#chatUltimasConversas").animate({scrollTop: 0}, 'slow');
}

function chat_ultimas_conversas() {
    $.get("chat/ultimas_conversas", function (data) {
        if (data.success) {
            var ultimas_conversas = '';

            $.each(data.success, function(i, item) {
                var avatar = item.avatar;

                var name = item.name;
                if (name.length > 23) {name = name.substring(0, 23)+' ...';}

                var mensagem = item.mensagem;
                if (mensagem.length > 23) {mensagem = mensagem.substring(0, 23)+' ...';}

                var data_time;
                if (dataAtualFormatada(2) == item.data_envio) {data_time = item.hora_envio.substring(0, 5);} else {data_time = item.data_envio;}

                var qtd_msg_nao_lida = item.qtd_msg_nao_lida;
                var qtd_msg_nao_lida_class = 'qtdmsg-meta';

                if (qtd_msg_nao_lida == 0) {
                    qtd_msg_nao_lida = '';
                    qtd_msg_nao_lida_class = '';
                }

                ultimas_conversas += '<div class="row sideBar-body chat_filtrar_ultimas_conversas" onclick="chat_montar_destinatario(2, '+item.id+', \''+item.avatar+'\', \''+item.name+'\');" data-filtro="'+item.name+'">';
                ultimas_conversas += '   <div class="col-sm-3 col-xs-3 sideBar-avatar">';
                ultimas_conversas += '       <div class="avatar-icon">';
                ultimas_conversas += '           <img src="'+avatar+'">';
                ultimas_conversas += '       </div>';
                ultimas_conversas += '   </div>';
                ultimas_conversas += '   <div class="col-sm-9 col-xs-9 sideBar-main">';
                ultimas_conversas += '       <div class="row">';
                ultimas_conversas += '           <div class="col-sm-8 col-xs-8 sideBar-name">';
                ultimas_conversas += '               <span class="name-meta">'+name+'</span><br>';
                ultimas_conversas += '               <span class="text-muted small">'+mensagem+'</span>';
                ultimas_conversas += '           </div>';
                ultimas_conversas += '           <div class="col-sm-4 col-xs-4 pull-right sideBar-time">';
                ultimas_conversas += '               <span class="time-meta float-end align-bottom">'+data_time+'</span><br>';
                ultimas_conversas += '               <span class="'+qtd_msg_nao_lida_class+' float-end align-bottom">'+qtd_msg_nao_lida+'</span>';
                ultimas_conversas += '           </div>';
                ultimas_conversas += '       </div>';
                ultimas_conversas += '   </div>';
                ultimas_conversas += '</div>';
            });

            $("#chatUltimasConversas").html(ultimas_conversas);
        } else {
            alert('Não encontrou o usuário logado');
        }
    });
}

//Montar Novas Conversas
function chat_montar_novas_conversas() {
    chat_novas_conversas();
    $("#chatNovasConversas").animate({scrollTop:0}, 'slow');
    chat_filtrar_novas_conversas();
}

function chat_novas_conversas() {
    $.get("chat/novas_conversas", function (data) {
        if (data.success) {
            var novas_conversas = '';

            $.each(data.success, function(i, item) {
                var avatar = item.avatar;

                var name = item.name;
                //if (name.length > 28) {name = name.substring(0, 28)+' ...';}

                novas_conversas += '<div class="row sideBar-body chat_filtrar_novas_conversas" onclick="chat_montar_destinatario(3, '+item.id+', \''+item.avatar+'\', \''+item.name+'\');" data-filtro="'+item.name+'">';
                novas_conversas += '   <div class="col-sm-3 col-xs-3 sideBar-avatar">';
                novas_conversas += '       <div class="avatar-icon">';
                novas_conversas += '           <img src="'+avatar+'">';
                novas_conversas += '       </div>';
                novas_conversas += '   </div>';
                novas_conversas += '   <div class="col-sm-9 col-xs-9 sideBar-main">';
                novas_conversas += '       <div class="row">';
                novas_conversas += '           <div class="col-sm-8 col-xs-8 sideBar-name">';
                novas_conversas += '               <span class="name-meta">'+name+'</span><br>';
                novas_conversas += '               <span class="text-muted small">&nbsp;</span>';
                novas_conversas += '           </div>';
                novas_conversas += '       </div>';
                novas_conversas += '   </div>';
                novas_conversas += '</div>';
            });

            $("#chatNovasConversas").html(novas_conversas);
        } else {
            alert('Não encontrou o usuário logado');
        }
    });
}

//Montar Conversas
function chat_montar_conversas() {
    chat_conversas();
    $("#chatConversas").animate({scrollTop:0}, 'slow');
    chat_gravar_como_lida();
}

function chat_conversas() {
    //Limpar conversas
    $("#chatConversas").html('');

    //Buscar hiddens
    var remetente_user_id = $("#remetente_user_id").val();
    var destinatario_user_id = $("#destinatario_user_id").val();

    $.get("chat/conversas/"+remetente_user_id+"/"+destinatario_user_id, function (data) {
        if (data.success) {
            var remetente_user_id = $("#remetente_user_id").val();
            var destinatario_user_id = $("#destinatario_user_id").val();

            var conversas = '';

            $.each(data.success, function(i, item) {
                var conversa_chat_id = item.id;
                var conversa_remetente_user_id = item.remetente_user_id;
                var conversa_destinatario_user_id = item.destinatario_user_id;
                var conversa_mensagem = item.mensagem;
                var conversa_data_envio = item.data_envio;
                var conversa_hora_envio = item.hora_envio;
                var conversa_data_recebimento = item.data_recebimento;
                var conversa_hora_recebimento = item.hora_recebimento;
                var conversa_data_leitura = item.data_leitura;
                var conversa_hora_leitura = item.hora_leitura;

                //Verificar qual class colocar (receiver ou sender)
                var conversa_class = '';
                if (conversa_remetente_user_id == remetente_user_id) {conversa_class = 'sender';}
                if (conversa_remetente_user_id == destinatario_user_id) {conversa_class = 'receiver';}

                //Verificar se já foi lida
                var conversa_lida = '';

                if (conversa_class == 'receiver') {
                    conversa_lida = 'conversa_lida';
                    if (conversa_data_leitura == null) {conversa_lida = 'conversa_nao_lida';}
                }

                conversas += '<div class="row message-body '+conversa_lida+'" data-chat_id="'+conversa_chat_id+'">';
                conversas += '  <div class="col-sm-12 message-main-'+conversa_class+'">';
                conversas += '      <div class="'+conversa_class+'">';
                conversas += '          <div class="message-text">'+conversa_mensagem+'</div>';
                conversas += '          <span class="message-time pull-right" style="font-size: 10px !important;">'+conversa_data_envio+' '+conversa_hora_envio+'</span>';
                conversas += '      </div>';
                conversas += '  </div>';
                conversas += '</div>';
            });

            $("#chatConversas").html(conversas);
        } else {
            alert('Não encontrou Conversas');
        }
    });
}

/*
* Montar os dados do Destinatário da Conversa
* @PARAM op=1 : veio da Iniciar Conversas
* @PARAM op=2 : veio da Últimas Conversas
* @PARAM op=3 : veio da Novas Conversas
 */
function chat_montar_destinatario(op, destinatario_user_id, avatar, name) {
    $("#chatDestinatarioFoto img").attr('src', avatar);
    $("#chatDestinatarioDescricao .descricao_nome").html(name);

    $("#destinatario_user_id").val(destinatario_user_id);

    //Se veio do Iniciar Conversas
    if (op == 1) {
        $("#chatDestinatarioFoto").hide();
    } else {
        $("#chatDestinatarioFoto").show();
    }

    //Se veio da Novas Conversas fechar o SlideBar
    if (op == 3) {$("#chatNovaConversaFechar").trigger('click');}

    chat_montar_conversas();
    chat_gravar_como_lida();
    chat_gravar_como_recebidas();
    chat_montar_ultimas_conversas();
}

function chat_filtrar_ultimas_conversas() {
    $(".chat_filtrar_ultimas_conversas").each(function(index) {
        var filtro = $(this).data('filtro').toLowerCase();
        var texto = $("#chatProcurarConversa").val().toLowerCase();
        var result = filtro.indexOf(texto);

        if (result != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function chat_filtrar_novas_conversas() {
    $(".chat_filtrar_novas_conversas").each(function(index) {
        var filtro = $(this).data('filtro').toLowerCase();
        var texto = $("#chatProcurarNovaConversa").val().toLowerCase();
        var result = filtro.indexOf(texto);

        if (result != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function chat_enviar_mensagem() {
    //Dados
    var remetente_user_id = $("#remetente_user_id").val();
    var destinatario_user_id = $("#destinatario_user_id").val();
    var mensagem = $("#chatTextareaEnviarMensagem").val();

    //Criticar
    if (remetente_user_id == 0) {
        alert('Usuário não está logado.');
        return false;
    }

    if (destinatario_user_id == 0) {
        alert('Escolha um destinatário para sua mensagem.');
        return false;
    }

    if (mensagem == '') {
        alert('Digite uma mensagem para enviar.');
        return false;
    }

    //Input
    $("#mensagem").val(mensagem);

    //Limpar
    $("#chatTextareaEnviarMensagem").val('');

    //Ajax
    $.ajax({
        data: $("#frm_chat").serialize(),
        url: "chat/enviar_mensagem",
        type: "POST",
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            if (response.success) {
                chat_montar_conversas();
                chat_gravar_como_lida();
                chat_gravar_como_recebidas();
                chat_montar_ultimas_conversas();
            } else {
                alert('Erro interno');
            }
        },
        error: function (data) {
            alert('Erro interno');
        },
        complete: function () {}
    });
}

function chat_gravar_como_lida_ANTERIOR() {
    var scrool_heigh = $("#chatConversas").height();
    var acerto = $("#chatConversas").offset().top - 30;

    $(".conversa_nao_lida").each(function(index) {
        var conversa_nao_lida_top = $(this).offset().top;

        if ((conversa_nao_lida_top - acerto) < scrool_heigh) {
            $(this).removeClass('conversa_nao_lida');

            var chat_id = $(this).data('chat_id');

            $.get("chat/gravar_como_lida/"+chat_id, function (data) {});

            chat_montar_ultimas_conversas();
        }
    });
}

function chat_gravar_como_lida() {
    $(".conversa_nao_lida").each(function(index) {
        //Pegando elemento
        var elemento = $(this);

        //Verificar se o elemento já está visível
        if (chat_elemento_visivel(elemento)) {
            $(this).removeClass('conversa_nao_lida');

            var chat_id = $(this).data('chat_id');

            $.get("chat/gravar_como_lida/"+chat_id, function (data) {});

            chat_montar_ultimas_conversas();
        }
    });
}

function chat_elemento_visivel(elem) {
    var $elem = $(elem);
    var windowTop = $(window).scrollTop();
    var windowBottom = windowTop + $(window).height();
    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return elemTop >= windowTop && elemBottom <= windowBottom;
}

function chat_gravar_como_recebidas() {
    $.get("chat/gravar_como_recebidas", function (data) {});
}

$(function() {
    //Abrir Modal do Chat (#chatModal)
    $("#chatIniciar").click(function() {
        //Montar Usuário Logado
        chat_usuario_logado();
        $("#chatModal").modal('show');
        chat_montar_destinatario(1, 0, '', '');
        chat_montar_ultimas_conversas();
    });

    //Mostrar Sidebar Esquerda com novos usuários
    $("#chatNovaConversa").click(function() {
        $(".side-two").css({"left": "0"});

        chat_montar_novas_conversas();
    });

    //Retornar Sidebar Esquerda com novos usuários
    $("#chatNovaConversaFechar").click(function() {
        $(".side-two").css({
            "left": "-100%"
        });
    });

    //Fechar Modal do Chat (#chatModal)
    $("#chatEncerrar").click(function() {
        $("#chatModal").modal('hide');
    });

    //Procurar Conversa
    $("#chatProcurarConversa").keyup(function() {
        chat_filtrar_ultimas_conversas();
    });

    //Procurar Novas Conversas
    $("#chatProcurarNovaConversa").keyup(function() {
        chat_filtrar_novas_conversas();
    });

    //TextArea Mensagem
    $("#chatTextareaEnviarMensagem").keydown(function(e) {
        var key = e.keyCode;

        //pressionou Enter
        if (key == 13) {
            e.preventDefault();

            chat_enviar_mensagem();
        }
    });

    //Button Mensagem
    $("#chatButtonEnviarMensagem").click(function(e) {
        chat_enviar_mensagem();
    });

    //Scrool do #charConversas
    $("#chatConversas").on("scroll resize", function() {
        chat_gravar_como_lida();
    });

    //Alterou tamanho da tela
    $(window).on('scroll resize', function() {
        chat_gravar_como_lida();
    });
});
