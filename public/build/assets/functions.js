function alunoExtraData(id='') {
    //Verificar se mandou id ou se veio do registro_id
    if (id == '') {id = $('#registro_id').val();}

    //URL
    var url_atual = window.location.protocol+'//'+window.location.host+'/';

    //Ajax
    $.ajax({
        processing: true,
        serverSide: true,
        type: "GET",
        url: url_atual+"alunos/extradata/"+id,
        data: {},
        datatype: "json",
        success: function (response) {
            //Lendo json
            let json = JSON.parse(response);

            //Lendo dados aluno
            let aluno = json.aluno;

            //Passando dados aluno
            $('.jsonAlunoFoto').attr('src', url_atual+aluno.foto);
            $('.jsonAlunoFuncao').html(aluno.funcaoName);
            $('.jsonAlunoEscolaridade').html(aluno.escolaridadeName);
            $('.jsonAlunoGenero').html(aluno.generoName);
            $('.jsonAlunoName').html(aluno.name);

            $('.jsonAlunoId').val(aluno.id);
            $('.jsonAlunoEmail').html(aluno.email);

            dataAdmissao = aluno.data_admissao;
            dataAdmissao = dataAdmissao.substring(8, 10)+'/'+dataAdmissao.substring(5, 7)+'/'+dataAdmissao.substring(0, 4);
            $('.jsonAlunoDataAdmissao').html(dataAdmissao);

            //Lendo dados transacoes (Totais)
            let transacoesCount = json.transacoesCount;

            //Lendo dados transacoes (Tabela)
            let transacoesTable = json.transacoesTable.transacoes;

            var tbodyTransacoes = '';

            if (transacoesTable != '') {
                //Passando dados transacoes (Tabela)
                var row = 0;

                function montarTable(item) {
                    row++;
                    operacaoName = item;

                    tbodyTransacoes += "<tr><th scope='row'>" + row + "</th><td>" + operacaoName + "</td></tr>";
                }

                transacoesTable.forEach(montarTable);
            }

            //Destruindo e iniciando (Simulando um Refresh)
            $('.class-datatable-2').DataTable().destroy();
            $('.jsonAlunoTransacoesTable').html(tbodyTransacoes);
            configurarDataTable(2);
        },
        complete: function () {},
        error: function (response) {
            alert('ERROR: '+response);
        }
    });
}

function funcionarioExtraData(id='') {
    //Verificar se mandou id ou se veio do registro_id
    if (id == '') {id = $('#registro_id').val();}

    //URL
    var url_atual = window.location.protocol+'//'+window.location.host+'/';

    //Ajax
    $.ajax({
        processing: true,
        serverSide: true,
        type: "GET",
        url: url_atual+"funcionarios/extradata/"+id,
        data: {},
        datatype: "json",
        success: function (response) {
            //Lendo json
            let json = JSON.parse(response);

            //Lendo dados funcionario
            let funcionario = json.funcionario;

            //Passando dados funcionario
            $('.jsonFuncionarioFoto').attr('src', url_atual+funcionario.foto);
            $('.jsonFuncionarioFuncao').html(funcionario.funcaoName);
            $('.jsonFuncionarioEscolaridade').html(funcionario.escolaridadeName);
            $('.jsonFuncionarioGenero').html(funcionario.generoName);
            $('.jsonFuncionarioName').html(funcionario.name);

            $('.jsonFuncionarioId').val(funcionario.id);
            $('.jsonFuncionarioEmail').html(funcionario.email);

            dataAdmissao = funcionario.data_admissao;
            dataAdmissao = dataAdmissao.substring(8, 10)+'/'+dataAdmissao.substring(5, 7)+'/'+dataAdmissao.substring(0, 4);
            $('.jsonFuncionarioDataAdmissao').html(dataAdmissao);

            //Lendo dados transacoes (Totais)
            let transacoesCount = json.transacoesCount;

            //Lendo dados transacoes (Tabela)
            let transacoesTable = json.transacoesTable.transacoes;

            var tbodyTransacoes = '';

            if (transacoesTable != '') {
                //Passando dados transacoes (Tabela)
                var row = 0;

                function montarTable(item) {
                    row++;
                    operacaoName = item;

                    tbodyTransacoes += "<tr><th scope='row'>" + row + "</th><td>" + operacaoName + "</td></tr>";
                }

                transacoesTable.forEach(montarTable);
            }

            //Destruindo e iniciando (Simulando um Refresh)
            $('.class-datatable-2').DataTable().destroy();
            $('.jsonFuncionarioTransacoesTable').html(tbodyTransacoes);
            configurarDataTable(2);
        },
        complete: function () {},
        error: function (response) {
            alert('ERROR: '+response);
        }
    });
}

function professorExtraData(id='') {
    //Verificar se mandou id ou se veio do registro_id
    if (id == '') {id = $('#registro_id').val();}

    //URL
    var url_atual = window.location.protocol+'//'+window.location.host+'/';

    //Ajax
    $.ajax({
        processing: true,
        serverSide: true,
        type: "GET",
        url: url_atual+"professores/extradata/"+id,
        data: {},
        datatype: "json",
        success: function (response) {
            //Lendo json
            let json = JSON.parse(response);

            //Lendo dados professor
            let professor = json.professor;

            //Passando dados professor
            $('.jsonProfessorFoto').attr('src', url_atual+professor.foto);
            $('.jsonProfessorFuncao').html(professor.funcaoName);
            $('.jsonProfessorEscolaridade').html(professor.escolaridadeName);
            $('.jsonProfessorGenero').html(professor.generoName);
            $('.jsonProfessorName').html(professor.name);

            $('.jsonProfessorId').val(professor.id);
            $('.jsonProfessorEmail').html(professor.email);

            dataAdmissao = professor.data_admissao;
            dataAdmissao = dataAdmissao.substring(8, 10)+'/'+dataAdmissao.substring(5, 7)+'/'+dataAdmissao.substring(0, 4);
            $('.jsonProfessorDataAdmissao').html(dataAdmissao);

            //Lendo dados transacoes (Totais)
            let transacoesCount = json.transacoesCount;

            //Lendo dados transacoes (Tabela)
            let transacoesTable = json.transacoesTable.transacoes;

            var tbodyTransacoes = '';

            if (transacoesTable != '') {
                //Passando dados transacoes (Tabela)
                var row = 0;

                function montarTable(item) {
                    row++;
                    operacaoName = item;

                    tbodyTransacoes += "<tr><th scope='row'>" + row + "</th><td>" + operacaoName + "</td></tr>";
                }

                transacoesTable.forEach(montarTable);
            }

            //Destruindo e iniciando (Simulando um Refresh)
            $('.class-datatable-2').DataTable().destroy();
            $('.jsonProfessorTransacoesTable').html(tbodyTransacoes);
            configurarDataTable(2);
        },
        complete: function () {},
        error: function (response) {
            alert('ERROR: '+response);
        }
    });
}

function notificacaoLerData(id) {
    //Buscar dados do Registro
    $.get("notificacoes/"+id, function (data) {
        //Lendo dados
        if (data.success) {
            $('.jsonNotificacaoLerTitulo').html(data.success.title);
            $('.jsonNotificacaoLerNotificacao').html(data.success.notificacao);
        } else if (data.error_not_found) {
            alertSwal('warning', "Registro não encontrado", '', 'true', 2000);
        } else if (data.error_permissao) {
            alertSwal('warning', "Permissão Negada", '', 'true', 2000);
        } else {
            alert('Erro interno');
        }
    });
}

//Marcar permissão -list quando escolher qualquer outra
function checkedPermissaoTable(opClick, submodulo_id) {
    //opClick = 1 : Clicou em todos_listar
    if (opClick == 1) {
        if ($('#todos_listar').is(':checked') == true) {
            for (id = 1; id <= 100; id++) {
                $('#listar_' + id).prop('checked', true);
            }
        } else {
            $('#todos_mostrar').prop('checked', false);
            $('#todos_criar').prop('checked', false);
            $('#todos_editar').prop('checked', false);
            $('#todos_deletar').prop('checked', false);

            for (id = 1; id <= 100; id++) {
                $('#listar_' + id).prop('checked', false);
                $('#mostrar_' + id).prop('checked', false);
                $('#criar_' + id).prop('checked', false);
                $('#editar_' + id).prop('checked', false);
                $('#deletar_' + id).prop('checked', false);
            }
        }
    }

    //opClick = 2 : Clicou em todos_mostrar
    if (opClick == 2) {
        if ($('#todos_mostrar').is(':checked') == true) {
            $('#todos_listar').prop('checked', true);

            for (id = 1; id <= 100; id++) {
                $('#mostrar_' + id).prop('checked', true);

                $('#listar_' + id).prop('checked', true);
            }
        } else {
            for (id = 1; id <= 100; id++) {
                $('#mostrar_' + id).prop('checked', false);
            }
        }
    }

    //opClick = 3 : Clicou em todos_criar
    if (opClick == 3) {
        if ($('#todos_criar').is(':checked') == true) {
            for (id = 1; id <= 100; id++) {
                $('#criar_' + id).prop('checked', true);

                $('#todos_listar').prop('checked', true);
                $('#listar_' + id).prop('checked', true);
            }
        } else {
            for (id = 1; id <= 100; id++) {
                $('#criar_' + id).prop('checked', false);
            }
        }
    }

    //opClick = 4 : Clicou em todos_editar
    if (opClick == 4) {
        if ($('#todos_editar').is(':checked') == true) {
            for (id = 1; id <= 100; id++) {
                $('#editar_' + id).prop('checked', true);

                $('#todos_listar').prop('checked', true);
                $('#listar_' + id).prop('checked', true);
            }
        } else {
            for (id = 1; id <= 100; id++) {
                $('#editar_' + id).prop('checked', false);
            }
        }
    }

    //opClick = 5 : Clicou em todos_deletar
    if (opClick == 5) {
        if ($('#todos_deletar').is(':checked') == true) {
            for (id = 1; id <= 100; id++) {
                $('#deletar_' + id).prop('checked', true);

                $('#todos_listar').prop('checked', true);
                $('#listar_' + id).prop('checked', true);
            }
        } else {
            for (id = 1; id <= 100; id++) {
                $('#deletar_' + id).prop('checked', false);
            }
        }
    }

    //opClick = 6 : Clicou em listar_
    if (opClick == 6) {
        if ($('#listar_' + submodulo_id).is(':checked') == false) {
            $('#todos_mostrar').prop('checked', false);
            $('#mostrar_' + submodulo_id).prop('checked', false);

            $('#todos_criar').prop('checked', false);
            $('#criar_' + submodulo_id).prop('checked', false);

            $('#todos_editar').prop('checked', false);
            $('#editar_' + submodulo_id).prop('checked', false);

            $('#todos_deletar').prop('checked', false);
            $('#deletar_' + submodulo_id).prop('checked', false);
        }
    }

    //opClick = 7 : Clicou em mostrar_
    if (opClick == 7) {
        if ($('#mostrar_' + submodulo_id).is(':checked') == true) {
            $('#listar_' + submodulo_id).prop('checked', true);
        }

        if ($('#mostrar_' + submodulo_id).is(':checked') == false) {
            $('#todos_mostrar').prop('checked', false);
        }
    }

    //opClick = 8 : Clicou em criar_
    if (opClick == 8) {
        if ($('#criar_' + submodulo_id).is(':checked') == true) {
            $('#listar_' + submodulo_id).prop('checked', true);
        }

        if ($('#criar_' + submodulo_id).is(':checked') == false) {
            $('#todos_criar').prop('checked', false);
        }
    }
    //opClick = 9 : Clicou em editar_
    if (opClick == 9) {
        if ($('#editar_' + submodulo_id).is(':checked') == true) {
            $('#listar_' + submodulo_id).prop('checked', true);
        }

        if ($('#editar_' + submodulo_id).is(':checked') == false) {
            $('#todos_editar').prop('checked', false);
        }
    }
    //opClick = 10 : Clicou em deletar_
    if (opClick == 10) {
        if ($('#deletar_' + submodulo_id).is(':checked') == true) {
            $('#listar_' + submodulo_id).prop('checked', true);
        }

        if ($('#deletar_' + submodulo_id).is(':checked') == false) {
            $('#todos_deletar').prop('checked', false);
        }
    }
}

//Modal de Confirmação
function alertSwalConfirmacao(callback) {
    Swal.fire({
        title: 'Confirma operação?',
        text: '',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Confirmar',
        confirmButtonColor: '#38c172',
        denyButtonText: `<i class="fa fa-thumbs-down"></i> Cancelar`,
        denyButtonColor: '#e3342f',
        customClass: {
            container: '...',
            popup: 'small',
            header: '...',
            title: 'h5',
            closeButton: '...',
            icon: 'small',
            image: '...',
            content: '...',
            htmlContainer: '...',
            input: '...',
            inputLabel: '...',
            validationMessage: '...',
            actions: '...',
            confirmButton: 'btn btn-success',
            denyButton: '...',
            cancelButton: 'btn btn-primary',
            loader: '...',
            footer: '....'
        }
    }).then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}

//Modal de Confirmação com submit
function alertSwalConfirmacaoSubmit(frm_name) {
    Swal.fire({
        title: 'Confirma operação?',
        text: '',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Confirmar',
        confirmButtonColor: '#38c172',
        denyButtonText: `<i class="fa fa-thumbs-down"></i> Cancelar`,
        denyButtonColor: '#e3342f',
        customClass: {
            container: '...',
            popup: 'small',
            header: '...',
            title: 'h5',
            closeButton: '...',
            icon: 'small',
            image: '...',
            content: '...',
            htmlContainer: '...',
            input: '...',
            inputLabel: '...',
            validationMessage: '...',
            actions: '...',
            confirmButton: 'btn btn-success',
            denyButton: '...',
            cancelButton: 'btn btn-primary',
            loader: '...',
            footer: '....'
        }
    }).then((confirmed) => {
        $('#'+frm_name).submit();
    });
}

//Modal para Mensagens
function alertSwal(icon='success', title='', html='', showConfirmButton=false, timer=2000) {
    Swal.fire({
        icon: icon,
        title: title,
        html: html,
        showConfirmButton: showConfirmButton,
        timer: timer
    });
}

//visualizar a imagem da font awesome em uma div ao lado
function viewFontAwesome(field) {
    if ($('#'+field).val() != '') {
        const image_view = $('#image_view');
        image_view.attr('class', $('#'+field).val());
    }
}

//Submódulo Dashboards''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//Função para buscar dados na API
function dashboardsUsers(id) {
    //URL
    var url_atual = window.location.protocol + '//' + window.location.host + '/';

    //Header
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });

    //Ajax
    $.ajax({
        processing: true,
        serverSide: true,
        type: "GET",
        url: url_atual + "dashboards",
        data: '&id=' + id + '&data=dashboardsUsers',
        datatype: "json",
        success: function (response) {
            //Lendo json
            let json = JSON.parse(response);

            //Lendo dados
            let dados = json.dashboardsUsersDados;

            //Variaveis
            dashboardsUsersDropdown = "<a class='dropdown-item' href='#' onclick='dashboardsUsers(0)'>Todos</a>";
            dashboardsUsersTabela = '';

            //loop
            if (dados != '') {
                dados.forEach(function (item, index) {
                    /* id, name, avatar, grupo, quantidade_grupos, situacao, quantidade_situacoes, quantidade_operacoes_1, quantidade_operacoes_2, quantidade_operacoes_3 */

                    //Dados para Dropdown
                    if (item.id != 0) {
                        dashboardsUsersDropdown += "<a class='dropdown-item' href='#' onclick='dashboardsUsers("+item.id+")'>" + item.name + "</a>";
                    }

                    //Preencher dados principais
                    if (item.id == id) {
                        $('#dashboardsUsersFoto').attr('src', url_atual + item.avatar);
                        $('#dashboardsUsersNome').html(item.name);
                        $('#dashboardsUsersGrupos').html(item.quantidade_grupos);
                        $('#dashboardsUsersSituacoes').html(item.quantidade_situacoes);
                        $('#dashboardsUsersOperacoes').html(item.quantidade_operacoes_1 + item.quantidade_operacoes_2 + item.quantidade_operacoes_3);
                    }

                    //Linhas da Tabela
                    if (item.id != 0) {
                        if (item.situacao == 'Liberado') {situacao = "<span class='text-success'>"+item.situacao+"</span>";}
                        if (item.situacao == 'Bloqueado') {situacao = "<span class='text-danger'>"+item.situacao+"</span>";}

                        dashboardsUsersTabela += '<tr>';
                        dashboardsUsersTabela += '<td class="font-size-12">' + item.name + '</td>';
                        dashboardsUsersTabela += '<td class="font-size-12">' + item.grupo + '<br>' + situacao + '</td>';
                        dashboardsUsersTabela += '<td class="font-size-12 text-center">' + (item.quantidade_operacoes_1 + item.quantidade_operacoes_2 + item.quantidade_operacoes_3) + '</td>';
                        dashboardsUsersTabela += '</tr>';
                    }
                });
            }

            $('#dashboardsUsersDropdown').html(dashboardsUsersDropdown);
            $('#dashboardsUsersTabela').html(dashboardsUsersTabela);
        },
        complete: function () {
        },
        error: function (response) {
            alert('ERROR: ' + response);
        }
    });
}

//Função para buscar dados na API
function dashboardsProfessores(id) {
    //URL
    var url_atual = window.location.protocol + '//' + window.location.host + '/';

    //Header
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });

    //Ajax
    $.ajax({
        processing: true,
        serverSide: true,
        type: "GET",
        url: url_atual + "dashboards",
        data: '&id=' + id + '&data=dashboardsProfessores',
        datatype: "json",
        success: function (response) {
            //Lendo json
            let json = JSON.parse(response);

            //Lendo dados
            let dados = json.dashboardsProfessoresDados;

            //Variaveis
            dashboardsProfessoresDropdown = "<a class='dropdown-item' href='#' onclick='dashboardsProfessores(0)'>Todos</a>";
            dashboardsProfessoresTabela = '';

            //loop
            if (dados != '') {
                dados.forEach(function (item, index) {
                    /* id, name, avatar, grupo, quantidade_grupos, situacao, quantidade_situacoes, quantidade_operacoes_1, quantidade_operacoes_2, quantidade_operacoes_3 */

                    //Dados para Dropdown
                    if (item.id != 0) {
                        dashboardsProfessoresDropdown += "<a class='dropdown-item' href='#' onclick='dashboardsProfessores("+item.id+")'>" + item.name + "</a>";
                    }

                    //Preencher dados principais
                    if (item.id == id) {
                        $('#dashboardsProfessoresFoto').attr('src', url_atual + item.foto);
                        $('#dashboardsProfessoresNome').html(item.name);
                        $('#dashboardsProfessoresEscolas').html(item.quantidade_escolas);
                        $('#dashboardsProfessoresTurmas').html(item.quantidade_turmas);
                        $('#dashboardsProfessoresAlunos').html(item.quantidade_alunos);
                    }

                    //Linhas da Tabela
                    if (item.id != 0) {
                        dashboardsProfessoresTabela += '<tr>';
                        dashboardsProfessoresTabela += '<td class="font-size-12">' + item.name + '</td>';
                        dashboardsProfessoresTabela += '<td class="font-size-12">' + item.escolas + '</td>';
                        dashboardsProfessoresTabela += '<td class="font-size-12">' + item.turmas + '</td>';
                        dashboardsProfessoresTabela += '<td class="font-size-12">' + item.alunos + '</td>';
                        dashboardsProfessoresTabela += '</tr>';
                    }
                });
            }

            $('#dashboardsProfessoresDropdown').html(dashboardsProfessoresDropdown);
            $('#dashboardsProfessoresTabela').html(dashboardsProfessoresTabela);
        },
        complete: function () {
        },
        error: function (response) {
            alert('ERROR: ' + response);
        }
    });
}
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

//Submódulo Alunos''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//Função para buscar dados na API (Documentos pdf do aluno para colocar na grade)
//Paran op (1 view) (2 edit)
function montar_grade_documentos_aluno(op) {
    $.get('alunos/' + $('#registro_id').val(), function (data) {
        let alunoDocumentos = data.success['alunoDocumentos'];

        //Montar a grade
        var linha = '';
        $.each(alunoDocumentos, function(i, item) {
            var caminho = window.location.protocol+'//'+window.location.host+'/'+item.caminho;

            linha += '<tr>';
            linha += '  <th scope="row">'+(i+1)+'</th>';
            linha += '      <td>'+item.descricao+'</td>';
            linha += '      <td style="vertical-align:top; white-space:nowrap;">';
            linha += '          <div class="row">';
            linha += '              <div class="col-1">';
            linha += '                  <button type="button" class="btn btn-outline-info text-center btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar Documento" onclick="window.open(\''+caminho+'\', \'_blank\');"><i class="fa fa-file-pdf font-size-18"></i></button>';
            linha += '              </div>';

            //Botão Deletar documento
            if (op == 2) {
                linha += '              <div class="col-1">';
                linha += '                  <button type="button" class="btn btn-outline-danger text-center btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Documento" onclick="deletar_documentos_aluno(' + item.id + ');"><i class="fa fa-trash-alt font-size-18"></i></button>';
                linha += '              </div>';
            }

            linha += '          </div>';
            linha += '      </td>';
            linha += '</tr>';
        });

        $('#tbodyDocumentoUpload').html(linha);
    });
}

//Função para deletar documento da grade
function deletar_documentos_aluno(aluno_documento_id) {
    //Confirmação de Delete
    alertSwalConfirmacao(function (confirmed) {
        if (confirmed) {
            $.ajax({
                type: "DELETE",
                url: "alunos/deletar_documento/" + aluno_documento_id
            });

            montar_grade_documentos_aluno(2);
        }
    });
}
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

//Submódulo Nees''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//Função para buscar dados na API (Documentos pdf da nee para colocar na grade)
//Paran op (1 view) (2 edit)
function montar_grade_documentos_nee(op) {
    $.get('nees/' + $('#registro_id').val(), function (data) {
        let neeDocumentos = data.success['neeDocumentos'];

        //Montar a grade
        var linha = '';
        $.each(neeDocumentos, function(i, item) {
            var caminho = window.location.protocol+'//'+window.location.host+'/'+item.caminho;

            linha += '<tr>';
            linha += '  <th scope="row">'+(i+1)+'</th>';
            linha += '      <td>'+item.descricao+'</td>';
            linha += '      <td style="vertical-align:top; white-space:nowrap;">';
            linha += '          <div class="row">';
            linha += '              <div class="col-1">';
            linha += '                  <button type="button" class="btn btn-outline-info text-center btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar Documento" onclick="window.open(\''+caminho+'\', \'_blank\');"><i class="fa fa-file-pdf font-size-18"></i></button>';
            linha += '              </div>';

            //Botão Deletar documento
            if (op == 2) {
                linha += '              <div class="col-1">';
                linha += '                  <button type="button" class="btn btn-outline-danger text-center btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Documento" onclick="deletar_documentos_nee(' + item.id + ');"><i class="fa fa-trash-alt font-size-18"></i></button>';
                linha += '              </div>';
            }

            linha += '          </div>';
            linha += '      </td>';
            linha += '</tr>';
        });

        $('#tbodyDocumentoUpload').html(linha);
    });
}

//Função para deletar documento da grade
function deletar_documentos_nee(nee_documento_id) {
    //Confirmação de Delete
    alertSwalConfirmacao(function (confirmed) {
        if (confirmed) {
            $.ajax({
                type: "DELETE",
                url: "nees/deletar_documento/" + nee_documento_id
            });

            montar_grade_documentos_nee(2);
        }
    });
}
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

//Funções para Api ViaCep Para rodar em formulario sem REPEATER (Inicio)''''''''''''''''''''''''''''''''''''''''''''''''

//FORMULARIO COM CAMPOS SIMPLES'''''''''''''''''''''''''''''''''''''''''''''
function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('logradouro').value=("");
    document.getElementById('bairro').value=("");
    document.getElementById('localidade').value=("");
    document.getElementById('uf').value=("");
    //document.getElementById('ibge').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('logradouro').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('localidade').value=(conteudo.localidade);
        document.getElementById('uf').value=(conteudo.uf);
        //document.getElementById('ibge').value=(conteudo.ibge);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('logradouro').value="...";
            document.getElementById('bairro').value="...";
            document.getElementById('localidade').value="...";
            document.getElementById('uf').value="...";
            //document.getElementById('ibge').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

//FORMULARIO COM CAMPOS _COBRANCA'''''''''''''''''''''''''''''''''''''''''''
function limpa_formulário_cep_cobranca() {
    //Limpa valores do formulário de cep_cobranca.
    document.getElementById('logradouro_cobranca').value=("");
    document.getElementById('bairro_cobranca').value=("");
    document.getElementById('localidade_cobranca').value=("");
    document.getElementById('uf_cobranca').value=("");
    //document.getElementById('ibge_cobranca').value=("");
}

function meu_callback_cobranca(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('logradouro_cobranca').value=(conteudo.logradouro);
        document.getElementById('bairro_cobranca').value=(conteudo.bairro);
        document.getElementById('localidade_cobranca').value=(conteudo.localidade);
        document.getElementById('uf_cobranca').value=(conteudo.uf);
        //document.getElementById('ibge_cobranca').value=(conteudo.ibge);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep_cobranca();
        alert("CEP não encontrado.");
    }
}

function pesquisacep_cobranca(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('logradouro_cobranca').value="...";
            document.getElementById('bairro_cobranca').value="...";
            document.getElementById('localidade_cobranca').value="...";
            document.getElementById('uf_cobranca').value="...";
            //document.getElementById('ibge_cobranca').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback_cobranca';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep_cobranca();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep_cobranca();
    }
};
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//Funções para Api ViaCep Para rodar em formulario sem REPEATER (Fim)'''''''''''''''''''''''''''''''''''''''''''''''''''

//Funções para Api ViaCep Para rodar em formulario com REPEATER (Inicio)'''''''''''''''''''''''''''''''''''''''''''''''''
function limpa_formulário_cep_repeater() {
    //Limpa valores do formulário de cep.
    $("input[type=text][name='endereco["+$('#ctrl_endereco_indice').val()+"][a_endereco]']").val('');
}

function meu_callback_repeater(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        $("input[type=text][name='endereco["+$('#ctrl_endereco_indice').val()+"][a_endereco]']")
            .val(conteudo.logradouro+', '+
                $("input[type=text][name='endereco["+$('#ctrl_endereco_indice').val()+"][a_numero]']").val()+' - '+
                $("input[type=text][name='endereco["+$('#ctrl_endereco_indice').val()+"][a_complemento]']").val()+' - '+
                conteudo.bairro+' - '+
                conteudo.localidade+' - '+
                conteudo.uf);
    } else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep_repeater(indice) {
    //retornar o indice do campo
    $('#ctrl_endereco_indice').val(indice);

    //Valor do campo CEP
    var valorCampoCep = $("input[type=text][name='endereco["+indice+"][a_cep]']").val();

    //Nova variável "cep" somente com dígitos.
    var cep = valorCampoCep.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("input[type=text][name='endereco["+indice+"][a_endereco]']").val('...');

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
//Funções para Api ViaCep Para rodar em formulario com REPEATER (Fim)'''''''''''''''''''''''''''''''''''''''''''''''''''
