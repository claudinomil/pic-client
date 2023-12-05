/*
* Montar os dados do Destinatário da Conversa
* @PARAM op=1 : veio da Iniciar Conversas
* @PARAM op=2 : veio da Últimas Conversas
* @PARAM op=3 : veio da Novas Conversas
 */
function mensagens_montar_destinatario(op, destinatario_user_id, avatar, name) {
    $("#mensagensDestinatarioFoto img").attr('src', avatar);
    $("#mensagensDestinatarioDescricao .descricao_nome").html(name);

    $("#destinatario_user_id").val(destinatario_user_id);

    //Se veio do Iniciar Conversas
    if (op == 1) {
        $("#mensagensDestinatarioFoto").hide();
    } else {
        $("#mensagensDestinatarioFoto").show();
    }

    //Se veio da Novas Conversas fechar o SlideBar
    if (op == 3) {$("#mensagensNovaConversaFechar").trigger('click');}

    //Gravar mensagens como lida e atualizar
    mensagens_atualizar(2);
}

function mensagens_filtrar_ultimas_conversas() {
    $(".mensagens_filtrar_ultimas_conversas").each(function(index) {
        var filtro = $(this).data('filtro').toLowerCase();
        var texto = $("#mensagensProcurarConversa").val().toLowerCase();
        var result = filtro.indexOf(texto);

        if (result != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function mensagens_filtrar_novas_conversas() {
    $(".mensagens_filtrar_novas_conversas").each(function(index) {
        var filtro = $(this).data('filtro').toLowerCase();
        var texto = $("#mensagensProcurarNovaConversa").val().toLowerCase();
        var result = filtro.indexOf(texto);

        if (result != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

/*
* Atualizar
* @PARAM opcao=0 : Trás os dados para montar Usuário Logado / Novas Conversas / Ultimas Conversas / Conversas
* @PARAM opcao=1 : Grava Mensagem e Última Mensagem /// Trás os dados para montar Usuário Logado / Novas Conversas / Ultimas Conversas / Conversas
* @PARAM opcao=2 : Grava Mensagens como lida /// Trás os dados para montar Usuário Logado / Novas Conversas / Ultimas Conversas / Conversas
 */
function mensagens_atualizar(opcao=0) {
    //Campo opcao
    $("#opcao").val(opcao);

    //Dados
    var opcao = $("#opcao").val();
    var remetente_user_id = $("#remetente_user_id").val();
    var destinatario_user_id = $("#destinatario_user_id").val();
    var mensagem = $("#mensagensTextareaEnviarMensagem").val();
    mensagem = mensagem.trim();

    //Criticar
    if (opcao == 1 && remetente_user_id == 0) {
        alert('Usuário não está logado.');
        return false;
    }

    if (opcao == 1 && destinatario_user_id == 0) {
        alert('Escolha um destinatário para sua mensagem.');
        return false;
    }

    if (opcao == 1 && (mensagem == '' || mensagem === null)) {
        alert('Digite uma mensagem para enviar.');
        return false;
    }

    //Input
    $("#mensagem").val(mensagem);

    //Limpar
    $("#mensagensTextareaEnviarMensagem").val('');

    //Ajax
    $.ajax({
        data: $("#frm_mensagens").serialize(),
        url: "mensagens/atualizar",
        type: "POST",
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            if (response.success) {
                //Usuário Logado
                var usuario_logado = response.success.usuario_logado;
                mensagens_usuario_logado(usuario_logado);

                //Novas Conversas
                var novas_conversas = response.success.novas_conversas;
                mensagens_novas_conversas(novas_conversas);

                //Últimas Conversas
                var ultimas_conversas = response.success.ultimas_conversas;
                mensagens_ultimas_conversas(ultimas_conversas);

                //Conversas
                var conversas = response.success.conversas;
                mensagens_conversas(conversas);
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

function mensagens_usuario_logado(data) {
    var id = data.id;
    var avatar = data.avatar;
    var name = data.name;

    $("#mensagensUserLogadoFoto img").attr('src', avatar);
    $("#mensagensUserLogadoDescricao .descricao_nome").html(name);
    $("#remetente_user_id").val(id);
}

function mensagens_novas_conversas(data) {
    var novas_conversas = '';

    $.each(data, function(i, item) {
        var id = item.id;
        var avatar = item.avatar;
        var name_completo = item.name;
        var name = item.name;
        if (name.length > 28) {name = name.substring(0, 28)+' ...';}

        novas_conversas += '<div class="row sideBar-body mensagens_filtrar_novas_conversas" onclick="mensagens_montar_destinatario(3, '+id+', \''+avatar+'\', \''+name+'\');" data-filtro="'+name_completo+'">';
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

    $("#mensagensNovasConversas").html(novas_conversas);
    $("#mensagensNovasConversas").animate({scrollTop:0}, 'slow');
}

function mensagens_ultimas_conversas(data) {
    var ultimas_conversas = '';

    $.each(data, function(i, item) {
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

        ultimas_conversas += '<div class="row sideBar-body mensagens_filtrar_ultimas_conversas" onclick="mensagens_montar_destinatario(2, '+item.id+', \''+item.avatar+'\', \''+item.name+'\');" data-filtro="'+item.name+'">';
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

    $("#mensagensUltimasConversas").html(ultimas_conversas);
    $("#mensagensUltimasConversas").animate({scrollTop: 0}, 'slow');
}

function mensagens_conversas(data) {
    var conversas = '';

    var remetente_user_id = $("#remetente_user_id").val();
    var destinatario_user_id = $("#destinatario_user_id").val();

    $.each(data, function(i, item) {
        var conversa_mensagens_id = item.id;
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

        conversas += '<div class="row message-body '+conversa_lida+'" data-mensagens_id="'+conversa_mensagens_id+'">';
        conversas += '  <div class="col-sm-12 message-main-'+conversa_class+'">';
        conversas += '      <div class="'+conversa_class+'">';
        conversas += '          <div class="message-text">'+conversa_mensagem+'</div>';
        conversas += '          <span class="message-time pull-right" style="font-size: 10px !important;">'+conversa_data_envio+' '+conversa_hora_envio+'</span>';
        conversas += '      </div>';
        conversas += '  </div>';
        conversas += '</div>';
    });

    $("#mensagensConversas").html(conversas);


    var div = $("#mensagensConversas");
    div.prop("scrollTop", div.prop("scrollHeight"));
}

$(document).ready(function () {
    //Mostrar Sidebar com novos usuários
    $("#mensagensNovaConversa").click(function() {
        $('.viewUltimasConversas').hide();
        $('.viewNovasConversas').show();

        mensagens_filtrar_novas_conversas();
    });

    //Retornar Sidebar com novos usuários
    $("#mensagensNovaConversaFechar").click(function() {
        $('.viewUltimasConversas').show();
        $('.viewNovasConversas').hide();
    });

    //Procurar Conversa
    $("#mensagensProcurarConversa").keydown(function() {
        mensagens_filtrar_ultimas_conversas();
    });

    //Procurar Novas Conversas
    $("#mensagensProcurarNovaConversa").keydown(function() {
        mensagens_filtrar_novas_conversas();
    });

    //TextArea Mensagem
    $("#mensagensTextareaEnviarMensagem").keydown(function(e) {
        var key = e.keyCode;

        //pressionou Enter
        if (key == 13) {
            e.preventDefault();

            //Gravar mensagens e atualizar
            mensagens_atualizar(1);
        }
    });

    //Button Mensagem
    $("#mensagensButtonEnviarMensagem").click(function(e) {
        //Gravar mensagens e atualizar
        mensagens_atualizar(1);
    });

    ////Atualizar - Executar ao entrar
    mensagens_atualizar();
});
