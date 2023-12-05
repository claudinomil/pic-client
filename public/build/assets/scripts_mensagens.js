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

    mensagens_montar_conversas();
    // mensagens_gravar_como_lida();
    // mensagens_gravar_como_recebidas();
    mensagens_ultimas_conversas();
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

function mensagens_enviar_mensagem() {
    //Dados
    var remetente_user_id = $("#remetente_user_id").val();
    var destinatario_user_id = $("#destinatario_user_id").val();
    var mensagem = $("#mensagensTextareaEnviarMensagem").val();

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
    $("#mensagensTextareaEnviarMensagem").val('');

    //Ajax
    $.ajax({
        data: $("#frm_mensagens_enviadas").serialize(),
        url: "mensagens/enviar_mensagem",
        type: "POST",
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            if (response.success) {
                mensagens_montar_conversas();
                // mensagens_gravar_como_lida();
                // mensagens_gravar_como_recebidas();
                //mensagens_ultimas_conversas();
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

function mensagens_montar_conversas() {
    //Limpar conversas
    $("#mensagensConversas").html('');

    //Buscar hiddens
    var remetente_user_id = $("#remetente_user_id").val();
    var destinatario_user_id = $("#destinatario_user_id").val();

    $.get("mensagens/conversas/"+remetente_user_id+"/"+destinatario_user_id, function (data) {
        if (data.success) {
            var remetente_user_id = $("#remetente_user_id").val();
            var destinatario_user_id = $("#destinatario_user_id").val();

            var conversas = '';

            $.each(data.success, function(i, item) {
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
        }
    });
}

function mensagens_ultimas_conversas() {
    $.get("mensagens/ultimas_conversas", function (data) {
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
        } else {
            alert('Não encontrou o usuário logado');
        }
    });

    $("#mensagensUltimasConversas").animate({scrollTop: 0}, 'slow');
}

$(document).ready(function () {
    //Mostrar Sidebar Esquerda com novos usuários
    $("#mensagensNovaConversa").click(function() {
        $('.viewUltimasConversas').hide();
        $('.viewNovasConversas').show();

        mensagens_filtrar_novas_conversas();
    });

    //Retornar Sidebar Esquerda com novos usuários
    $("#mensagensNovaConversaFechar").click(function() {
        $('.viewUltimasConversas').show();
        $('.viewNovasConversas').hide();
    });

    //Procurar Conversa
    $("#mensagensProcurarConversa").keyup(function() {
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

            mensagens_enviar_mensagem();
        }
    });

    //Button Mensagem
    $("#mensagensButtonEnviarMensagem").click(function(e) {
        mensagens_enviar_mensagem();
    });

    //Scrool do #charConversas
    $("#mensagensConversas").on("scroll resize", function() {
        mensagens_gravar_como_lida();
    });

    //Alterou tamanho da tela
    $(window).on('scroll resize', function() {
        mensagens_gravar_como_lida();
    });
});




//     mensagens_montar_destinatario(1, 0, '', '');
//     mensagens_montar_ultimas_conversas();



// function mensagens_usuario_logado() {
//     return new Promise((resolve, reject) => {
//         $.get("mensagens/usuario_logado", function (data) {
//             if (data.success) {
//                 $("#mensagensUserLogadoFoto img").attr('src', data.success.avatar);
//                 $("#mensagensUserLogadoDescricao .descricao_nome").html(data.success.name);
//
//                 $("#remetente_user_id").val(data.success.id);
//
//                 resolve();
//             } else {
//                 reject('Não encontrou o usuário logado');
//             }
//         });
//     });
// }

// //Montar Usuários Conversas
// function mensagens_montar_ultimas_conversas() {
//     mensagens_ultimas_conversas().then(resultado => {
//         $("#mensagensUltimasConversas").animate({scrollTop: 0}, 'slow');
//     }).catch(function (error) {
//         alert(error);
//     });
// }
//
// function mensagens_ultimas_conversas() {
//     return new Promise((resolve, reject) => {
//         $.get("mensagens/ultimas_conversas", function (data) {
//             if (data.success) {
//                 var ultimas_conversas = '';
//
//                 $.each(data.success, function(i, item) {
//                     var avatar = item.avatar;
//
//                     var name = item.name;
//                     if (name.length > 23) {name = name.substring(0, 23)+' ...';}
//
//                     var mensagem = item.mensagem;
//                     if (mensagem.length > 23) {mensagem = mensagem.substring(0, 23)+' ...';}
//
//                     var data_time;
//                     if (dataAtualFormatada(2) == item.data_envio) {data_time = item.hora_envio.substring(0, 5);} else {data_time = item.data_envio;}
//
//                     var qtd_msg_nao_lida = item.qtd_msg_nao_lida;
//                     var qtd_msg_nao_lida_class = 'qtdmsg-meta';
//
//                     if (qtd_msg_nao_lida == 0) {
//                         qtd_msg_nao_lida = '';
//                         qtd_msg_nao_lida_class = '';
//                     }
//
//                     ultimas_conversas += '<div class="row sideBar-body mensagens_filtrar_ultimas_conversas" onclick="mensagens_montar_destinatario(2, '+item.id+', \''+item.avatar+'\', \''+item.name+'\');" data-filtro="'+item.name+'">';
//                     ultimas_conversas += '   <div class="col-sm-3 col-xs-3 sideBar-avatar">';
//                     ultimas_conversas += '       <div class="avatar-icon">';
//                     ultimas_conversas += '           <img src="'+avatar+'">';
//                     ultimas_conversas += '       </div>';
//                     ultimas_conversas += '   </div>';
//                     ultimas_conversas += '   <div class="col-sm-9 col-xs-9 sideBar-main">';
//                     ultimas_conversas += '       <div class="row">';
//                     ultimas_conversas += '           <div class="col-sm-8 col-xs-8 sideBar-name">';
//                     ultimas_conversas += '               <span class="name-meta">'+name+'</span><br>';
//                     ultimas_conversas += '               <span class="text-muted small">'+mensagem+'</span>';
//                     ultimas_conversas += '           </div>';
//                     ultimas_conversas += '           <div class="col-sm-4 col-xs-4 pull-right sideBar-time">';
//                     ultimas_conversas += '               <span class="time-meta float-end align-bottom">'+data_time+'</span><br>';
//                     ultimas_conversas += '               <span class="'+qtd_msg_nao_lida_class+' float-end align-bottom">'+qtd_msg_nao_lida+'</span>';
//                     ultimas_conversas += '           </div>';
//                     ultimas_conversas += '       </div>';
//                     ultimas_conversas += '   </div>';
//                     ultimas_conversas += '</div>';
//                 });
//
//                 $("#mensagensUltimasConversas").html(ultimas_conversas);
//
//                 resolve();
//             } else {
//                 reject('Não encontrou o usuário logado');
//             }
//         });
//     });
// }

// //Montar Novas Conversas
// function mensagens_novas_conversas() {
//     mensagens_novas_conversas().then(resultado => {
//         $("#mensagensNovasConversas").animate({scrollTop:0}, 'slow');
//
//         mensagens_filtrar_novas_conversas();
//     }).catch(function(error) {
//         alert(error);
//     });
// }
//
// function mensagens_novas_conversas() {
//     return new Promise((resolve, reject) => {
//         $.get("mensagens/novas_conversas", function (data) {
//             if (data.success) {
//                 var novas_conversas = '';
//
//                 $.each(data.success, function(i, item) {
//                     var avatar = item.avatar;
//
//                     var name = item.name;
//                     //if (name.length > 28) {name = name.substring(0, 28)+' ...';}
//
//                     novas_conversas += '<div class="row sideBar-body mensagens_filtrar_novas_conversas" onclick="mensagens_montar_destinatario(3, '+item.id+', \''+item.avatar+'\', \''+item.name+'\');" data-filtro="'+item.name+'">';
//                     novas_conversas += '   <div class="col-sm-3 col-xs-3 sideBar-avatar">';
//                     novas_conversas += '       <div class="avatar-icon">';
//                     novas_conversas += '           <img src="'+avatar+'">';
//                     novas_conversas += '       </div>';
//                     novas_conversas += '   </div>';
//                     novas_conversas += '   <div class="col-sm-9 col-xs-9 sideBar-main">';
//                     novas_conversas += '       <div class="row">';
//                     novas_conversas += '           <div class="col-sm-8 col-xs-8 sideBar-name">';
//                     novas_conversas += '               <span class="name-meta">'+name+'</span><br>';
//                     novas_conversas += '               <span class="text-muted small">&nbsp;</span>';
//                     novas_conversas += '           </div>';
//                     novas_conversas += '       </div>';
//                     novas_conversas += '   </div>';
//                     novas_conversas += '</div>';
//                 });
//
//                 $("#mensagensNovasConversas").html(novas_conversas);
//
//                 resolve();
//             } else {
//                 reject('Não encontrou o usuário logado');
//             }
//         });
//     });
// }

//Montar Conversas
// function mensagens_montar_conversas() {
//     mensagens_conversas().then(resultado => {
//         $("#mensagensConversas").animate({scrollTop:0}, 'slow');
//         mensagens_gravar_como_lida();
//     }).catch(function(error) {
//         alert(error);
//     });
// }
//



// function mensagens_filtrar_novas_conversas() {
//     $(".mensagens_filtrar_novas_conversas").each(function(index) {
//         var filtro = $(this).data('filtro').toLowerCase();
//         var texto = $("#mensagensProcurarNovaConversa").val().toLowerCase();
//         var result = filtro.indexOf(texto);
//
//         if (result != -1) {
//             $(this).show();
//         } else {
//             $(this).hide();
//         }
//     });
// }









function mensagens_gravar_como_lida() {
    $(".conversa_nao_lida").each(function(index) {
        //Pegando elemento
        var elemento = $(this);

        //Verificar se o elemento já está visível
        if (mensagens_elemento_visivel(elemento)) {
            $(this).removeClass('conversa_nao_lida');

            var mensagens_id = $(this).data('mensagens_id');

            $.get("mensagens/gravar_como_lida/"+mensagens_id, function (data) {});

            mensagens_montar_ultimas_conversas();
        }
    });
}

function mensagens_elemento_visivel(elem) {
    var $elem = $(elem);
    var windowTop = $(window).scrollTop();
    var windowBottom = windowTop + $(window).height();
    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return elemTop >= windowTop && elemBottom <= windowBottom;
}

function mensagens_gravar_como_recebidas() {
    $.get("mensagens/gravar_como_recebidas", function (data) {});
}

$(function() {
    // //Abrir Modal do Chat (#mensagensModal)
    // $("#mensagensIniciar").click(function() {
    //     //Montar Usuário Logado
    //     mensagens_usuario_logado().then(resultado => {
    //         $("#mensagensModal").modal('show');
    //     }).catch(function(error) {
    //         alert(error);
    //         return false;
    //     });
    //
    //     mensagens_montar_destinatario(1, 0, '', '');
    //     mensagens_montar_ultimas_conversas();
    // });

    // //Mostrar Sidebar Esquerda com novos usuários
    // $("#mensagensNovaConversa").click(function() {
    //     $(".side-two").css({"left": "0"});
    //
    //     mensagens_novas_conversas();
    // });
    //
    // //Retornar Sidebar Esquerda com novos usuários
    // $("#mensagensNovaConversaFechar").click(function() {
    //     $(".side-two").css({
    //         "left": "-100%"
    //     });
    // });
    //
    // //Fechar Modal do Chat (#mensagensModal)
    // $("#mensagensEncerrar").click(function() {
    //     $("#mensagensModal").modal('hide');
    // });
    //
    // //Procurar Conversa
    // $("#mensagensProcurarConversa").keyup(function() {
    //     mensagens_filtrar_ultimas_conversas();
    // });
    //
    // //Procurar Novas Conversas
    // $("#mensagensProcurarNovaConversa").keyup(function() {
    //     mensagens_filtrar_novas_conversas();
    // });
    //
    // //TextArea Mensagem
    // $("#mensagensTextareaEnviarMensagem").keydown(function(e) {
    //     var key = e.keyCode;
    //
    //     //pressionou Enter
    //     if (key == 13) {
    //         e.preventDefault();
    //
    //         mensagens_enviar_mensagem();
    //     }
    // });
    //
    // //Button Mensagem
    // $("#mensagensButtonEnviarMensagem").click(function(e) {
    //     mensagens_enviar_mensagem();
    // });
    //
    // //Scrool do #charConversas
    // $("#mensagensConversas").on("scroll resize", function() {
    //     mensagens_gravar_como_lida();
    // });
    //
    // //Alterou tamanho da tela
    // $(window).on('scroll resize', function() {
    //     mensagens_gravar_como_lida();
    // });
});
