$(document).ready(function () {
    if ($('#frm_dashboards').length) {
        $('#frm_dashboards').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    }
});

//Função para buscar dados na API
function dashboardsUsers(id) {
    //URL
    var url_atual = window.location.protocol + '//' + window.location.host + '/';

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

//Iniciar dashboardsUsers
dashboardsUsers(0);
dashboardsProfessores(0);
