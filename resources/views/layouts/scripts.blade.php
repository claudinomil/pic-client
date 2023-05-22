<!-- libs -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery-validation/jquery-validation.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery-validation/jquery-validation-pt-br.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/jquery-validation-methods.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/metismenu/metismenu.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/simplebar/simplebar.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/node-waves/node-waves.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jszip/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/pdfmake/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery-mask/jquery.mask.min.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/tinymce/tinymce.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/jquery-masks.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/template.js') }}"></script>
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/main.js') }}"></script>

<!-- functions.js -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/functions.js') }}"></script>

<!-- scripts_profiles.js -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/scripts_profiles.js') }}"></script>

@yield('script')

@yield('script-bottom')

<!-- scripts_template_init.js -->
<script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/scripts_template_init.js') }}"></script>

@if(isset($ajaxPrefixPermissaoSubmodulo))
    <!-- Script para CRUD Ajax -->
    <!-- Alguns Submódulos não tem CRUD, então entra na exceção -->
    <!-- Submódulos que não vão usar: Dashboards -->
    @if($ajaxPrefixPermissaoSubmodulo != 'dashboards' and $ajaxPrefixPermissaoSubmodulo != 'logos')
        {{-- Script para CRUD Ajax --}}
        <script type="text/javascript">
            $(function () {
                //Header
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });

                //Table
                tableContent('{{$ajaxPrefixPermissaoSubmodulo}}');

                function tableContent(route) {
                    //Avaliações - Entrar direto no Create''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                    @if($ajaxPrefixPermissaoSubmodulo == 'avaliacoes')
                    //Table Show/Hide
                    $('#crudTable').hide();

                    //retirando botão Cancelar
                    $('.crudFormCancelOperacao').hide();

                    //Verificar se o usuario já avaliou
                    $.get("{{$ajaxPrefixPermissaoSubmodulo}}/avaliar/user", function (data) {
                        if (!data.avaliar_user) {
                            $('#createNewRecord').trigger('click');
                        } else {
                            //Form Show/Hide
                            $('#crudForm').hide();

                            //crudAvaliado Show/Hide
                            $('#crudAvaliado').show();
                        }
                    });

                    //Parar a função tableContent
                    return;
                    @endif
                    //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                    $('.datatable-crud-ajax').DataTable({
                        language: {
                            pageLength: {
                                '-1': 'Mostrar todos os registros',
                                '_': 'Mostrar %d registros'
                            },
                            lengthMenu: 'Exibir _MENU_ resultados por página',
                            emptyTable: 'Nenhum registro encontrado',
                            info: 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
                            infoEmpty: 'Mostrando 0 até 0 de 0 registros',
                            infoFiltered: '(Filtrados de _MAX_ registros)',
                            infoThousands: '.',
                            loadingRecords: 'Carregando...',
                            processing: 'Processando...',
                            zeroRecords: 'Nenhum registro encontrado',
                            search: 'Pesquisar',
                            paginate: {
                                next: 'Próximo',
                                previous: 'Anterior',
                                first: 'Primeiro',
                                last: 'Último'
                            }
                        },
                        bDestroy: true,
                        responsive: true,
                        lengthChange: true,
                        autoWidth: true,
                        order: [],

                        processing: true,
                        serverSide: false,
                        ajax: route,
                        columns: [
                            @foreach($colsFields as $colField)
                                {'data': '{{$colField}}'},
                            @endforeach

                            @if($colActions == 'yes')
                                {'data': 'action'}
                            @endif
                        ]
                    });
                }

                //Search
                $('#searchRecords').click(function () {
                    //Recebendo field/value
                    var field = $('#pesquisar_field').val();
                    var value = $('#pesquisar_value').val();

                    if (field == '' || value == '') {
                        alert('Digite?');
                        return;
                    }

                    tableContent('{{$ajaxPrefixPermissaoSubmodulo}}/search/'+$('#pesquisar_field').val()+'/'+$('#pesquisar_value').val());
                });

                //Create
                $('#createNewRecord').click(function () {
                    //Passar pelo evento create do controller
                    $.get("{{$ajaxPrefixPermissaoSubmodulo}}/create", function (data) {
                        //Limpar validações
                        $('.is-invalid').removeClass('is-invalid');

                        //Limpar Formulário
                        $('#{{$ajaxNameFormSubmodulo}}').trigger('reset');

                        //Lendo dados
                        if (data.success) {
                            //Campo hidden frm_operacao
                            $('#frm_operacao').val('create');

                            //Campos do Formulário - disabled true/false
                            $('input').prop('disabled', false);
                            $('textarea').prop('disabled', false);
                            $('select').prop('disabled', false);
                            $('.select2').prop('disabled', false);

                            //Botões do Modal
                            $('#crudFormButtons1').show();
                            $('#crudFormButtons2').hide();

                            //Table Show/Hide
                            $('#crudTable').hide();

                            //Modal Show/Hide
                            $('#crudForm').show();

                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            //Settings'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                            @if($ajaxPrefixPermissaoSubmodulo == 'alunos')
                                //desmarcar checkboxs nee_id_
                                $('.cbNeeId').attr('checked', false);

                                //Aluno Documentos
                                $('#tbodyDocumentoUpload').html('');

                                //Display divInformacoesEducacionais
                                $('#divInformacoesEducacionais').hide();
                                $('#divInformacoesEducacionaisUpload').hide();
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'notificacoes')
                                $('.fieldsViewEdit').hide();
                                $('.fieldsCreate').show();
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'grupos')
                                $('.markUnmarkAll').show();

                                //Desabilitar/Habilitar opções de Show
                                $('.tdShow').hide();

                                //Desabilitar/Habilitar opções de Create/Edit
                                $('.tdCreateEdit').show();
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'ferramentas')
                                //Esconder botão buscar icones
                                $('#buscarIcones').show();

                                $('#iconView').removeClass();

                                $('.fieldsViewEdit').hide();
                                $('.fieldsCreate').show();
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'nees')
                                //Tinymce - limpando valor
                                tinymce.get('descricao').setContent('');
                                tinymce.get('descricao').getBody().setAttribute('contenteditable', true);

                                //Nee Documentos
                                $('#tbodyDocumentoUpload').html('');

                                //Display divDocumentosPdfs
                                $('#divDocumentosPdfs').hide();
                                $('#divDocumentosPdfsUpload').hide();
                            @endif
                            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                        } else if (data.error_permissao) {
                            alertSwal('warning', "Permissão Negada", '', 'true', 2000);
                        } else {
                            alert('Erro interno');
                        }
                    });
                });

                //View
                $('body').on('click', '.viewRecord', function () {
                    //Campo hidden registro_id
                    $('#registro_id').val($(this).data('id'));

                    //Buscar dados do Registro
                    $.get("{{$ajaxPrefixPermissaoSubmodulo}}/"+$('#registro_id').val(), function (data) {
                        //Limpar validações
                        $('.is-invalid').removeClass('is-invalid');

                        //Limpar Formulário
                        $('#{{$ajaxNameFormSubmodulo}}').trigger('reset');

                        //Lendo dados
                        if (data.success) {
                            //preencher formulário
                            @foreach($ajaxNamesFieldsSubmodulo as $field)
                                @if($field == 'id')
                                    $('#registro_id').val(data.success.id);
                                @else
                                    if ($('#{{$field}}').hasClass('select2')) {
                                        $('#{{$field}}').val(data.success['{{$field}}']).trigger('change');
                                    } else {
                                        $('#{{$field}}').val(data.success['{{$field}}']);
                                    }
                                @endif
                            @endforeach

                            //Campo hidden frm_operacao
                            $('#frm_operacao').val('view');

                            //Campos do Formulário - disabled true/false
                            $('input').prop('disabled', true);
                            $('textarea').prop('disabled', true);
                            $('select').prop('disabled', true);
                            $('.select2').prop('disabled', true);

                            //Botões do Modal
                            $('#crudFormButtons1').hide();
                            $('#crudFormButtons2').show();

                            //Table Show/Hide
                            $('#crudTable').hide();

                            //Modal Show/Hide
                            $('#crudForm').show();

                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            //Settings'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                            @if($ajaxPrefixPermissaoSubmodulo == 'alunos')
                                //desmarcar checkboxs nee_id_
                                $('.cbNeeId').attr('checked', false);

                                //AlunoNees
                                alunoNees = data.success['alunoNees'];

                                $.each(alunoNees, function(i, item) {
                                    //marcar como checado
                                    $('#nee_id_'+item.nee_id).attr('checked', true);
                                });

                                //Display divInformacoesEducacionais
                                $('#divInformacoesEducacionais').show();
                                $('#divInformacoesEducacionaisUpload').hide();

                                //AlunoDocumentos
                                alunoDocumentos = data.success['alunoDocumentos'];

                                montar_grade_documentos_aluno(1);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'notificacoes')
                                $('.fieldsViewEdit').show();
                                $('.fieldsCreate').hide();

                                $('#fieldDate').val(data.success['date']);
                                $('#fieldTime').val(data.success['time']);
                                $('#fieldUserName').val(data.success['userName']);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'grupos')
                                $('.markUnmarkAll').hide();

                                //Desabilitar/Habilitar opções de Show
                                $.each(data.success, function(i, item) {
                                    $('.show_'+i).show();
                                });

                                //Desabilitar/Habilitar opções de Create/Edit
                                $('.tdCreateEdit').hide();
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'ferramentas')
                                //Esconder botão buscar icones
                                $('#buscarIcones').hide();

                                $('#iconView').removeClass();
                                $('#iconView').addClass(data.success['icon']);

                                $('.fieldsViewEdit').show();
                                $('.fieldsCreate').hide();
                                $('#fieldUserName').val(data.success['userName']);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'nees')
                                //Tinymce - preenchendo com valor do campo
                                tinymce.get('descricao').setContent($('#descricao').val());
                                tinymce.get('descricao').getBody().setAttribute('contenteditable', false);

                                //Display divDocumentosPdfs
                                $('#divDocumentosPdfs').show();
                                $('#divDocumentosPdfsUpload').hide();

                                //NeeDocumentos
                                neeDocumentos = data.success['neeDocumentos'];

                                montar_grade_documentos_nee(1);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'avaliacoes')
                            //Verificar se precisa checked resposta_pergunta_1
                            if (data.success['resposta_pergunta_1'] == 1) {$('#resposta_pergunta_1_1').prop('checked', true);}
                            if (data.success['resposta_pergunta_1'] == 2) {$('#resposta_pergunta_1_2').prop('checked', true);}
                            if (data.success['resposta_pergunta_1'] == 3) {$('#resposta_pergunta_1_3').prop('checked', true);}

                            //Verificar se precisa checked resposta_pergunta_2
                            if (data.success['resposta_pergunta_2'] == 1) {$('#resposta_pergunta_2_1').prop('checked', true);}
                            if (data.success['resposta_pergunta_2'] == 2) {$('#resposta_pergunta_2_2').prop('checked', true);}
                            if (data.success['resposta_pergunta_2'] == 3) {$('#resposta_pergunta_2_3').prop('checked', true);}
                            @endif
                            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                        } else if (data.error_not_found) {
                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            alertSwal('warning', "Registro não encontrado", '', 'true', 2000);
                        } else if (data.error_permissao) {
                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            alertSwal('warning', "Permissão Negada", '', 'true', 2000);
                        } else {
                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            alert('Erro interno');
                        }
                    });
                });

                //Edit
                $('body').on('click', '.editRecord', function () {
                    //Campo hidden registro_id
                    if ($(this).data('id') != 0) {
                        $('#registro_id').val($(this).data('id'));
                    }

                    //Buscar dados do Registro
                    $.get("{{$ajaxPrefixPermissaoSubmodulo}}/"+$('#registro_id').val()+"/edit", function (data) {
                        //Limpar validações
                        $('.is-invalid').removeClass('is-invalid');

                        //Limpar Formulário
                        $('#{{$ajaxNameFormSubmodulo}}').trigger('reset');

                        //Lendo dados
                        if (data.success) {
                            //preencher formulário
                            @foreach($ajaxNamesFieldsSubmodulo as $field)
                                @if($field == 'id')
                                    $('#registro_id').val(data.success.id);
                                @else
                                    if ($('#{{$field}}').hasClass('select2')) {
                                        $('#{{$field}}').val(data.success['{{$field}}']).trigger('change');
                                    } else {
                                        $('#{{$field}}').val(data.success['{{$field}}']);
                                    }
                                @endif
                            @endforeach

                            //Campo hidden frm_operacao
                            $('#frm_operacao').val('edit');

                            //Campos do Formulário - disabled true/false
                            $('input').prop('disabled', false);
                            $('textarea').prop('disabled', false);
                            $('select').prop('disabled', false);
                            $('.select2').prop('disabled', false);

                            //Botões do Modal
                            $('#crudFormButtons1').show();
                            $('#crudFormButtons2').hide();

                            //Table Show/Hide
                            $('#crudTable').hide();

                            //Modal Show/Hide
                            $('#crudForm').show();

                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            //Settings'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                            @if($ajaxPrefixPermissaoSubmodulo == 'alunos')
                                //desmarcar checkboxs nee_id_
                                $('.cbNeeId').attr('checked', false);

                                //AlunoNees
                                alunoNees = data.success['alunoNees'];

                                $.each(alunoNees, function(i, item) {
                                    //marcar como checado
                                    $('#nee_id_'+item.nee_id).attr('checked', true);
                                });

                                //Display divInformacoesEducacionais
                                $('#divInformacoesEducacionais').show();
                                $('#divInformacoesEducacionaisUpload').show();

                                //AlunoDocumentos
                                alunoDocumentos = data.success['alunoDocumentos'];

                                montar_grade_documentos_aluno(2);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'notificacoes')
                                $('.fieldsViewEdit').show();
                                $('.fieldsCreate').hide();

                                $('#fieldDate').val(data.success['date']);
                                $('#fieldTime').val(data.success['time']);
                                $('#fieldUserName').val(data.success['userName']);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'grupos')
                                $('.markUnmarkAll').show();

                                //Desabilitar/Habilitar opções de Show
                                $('.tdShow').hide();

                                //Desabilitar/Habilitar opções de Create/Edit
                                $('.tdCreateEdit').show();

                                $.each(data.success, function(i, item) {
                                    $('.create_edit_'+i).prop('checked', true);
                                });
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'users')
                                $('#email').prop('readonly', true);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'ferramentas')
                                //Esconder botão buscar icones
                                $('#buscarIcones').show();

                                $('#iconView').removeClass();
                                $('#iconView').addClass(data.success['icon']);

                                $('.fieldsViewEdit').show();
                                $('.fieldsCreate').hide();
                                $('#fieldUserName').val(data.success['userName']);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'nees')
                                //Tinymce - preenchendo com valor do campo
                                tinymce.get('descricao').setContent($('#descricao').val());
                                tinymce.get('descricao').getBody().setAttribute('contenteditable', true);

                                //Display divDocumentosPdfs
                                $('#divDocumentosPdfs').show();
                                $('#divDocumentosPdfsUpload').show();

                                //NeeDocumentos
                                neeDocumentos = data.success['neeDocumentos'];

                                montar_grade_documentos_nee(2);
                            @endif

                            @if($ajaxPrefixPermissaoSubmodulo == 'avaliacoes')
                            //Verificar se precisa checked resposta_pergunta_1
                            if (data.success['resposta_pergunta_1'] == 1) {$('#resposta_pergunta_1_1').prop('checked', true);}
                            if (data.success['resposta_pergunta_1'] == 2) {$('#resposta_pergunta_1_2').prop('checked', true);}
                            if (data.success['resposta_pergunta_1'] == 3) {$('#resposta_pergunta_1_3').prop('checked', true);}

                            //Verificar se precisa checked resposta_pergunta_2
                            if (data.success['resposta_pergunta_2'] == 1) {$('#resposta_pergunta_2_1').prop('checked', true);}
                            if (data.success['resposta_pergunta_2'] == 2) {$('#resposta_pergunta_2_2').prop('checked', true);}
                            if (data.success['resposta_pergunta_2'] == 3) {$('#resposta_pergunta_2_3').prop('checked', true);}
                            @endif
                            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                        } else if (data.error_not_found) {
                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            alertSwal('warning', "Registro não encontrado", '', 'true', 2000);
                        } else if (data.error_permissao) {
                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            alertSwal('warning', "Permissão Negada", '', 'true', 2000);
                        } else {
                            //Removendo Máscaras
                            removeMask();

                            //Restaurando Máscaras
                            putMask();

                            alert('Erro interno');
                        }
                    });
                });

                //Delete
                $('body').on('click', '.deleteRecord', function () {
                    //Campo hidden registro_id
                    if ($(this).data('id') != 0) {
                        $('#registro_id').val($(this).data('id'));
                    }

                    //Confirmação de Delete
                    alertSwalConfirmacao(function (confirmed) {
                        if (confirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{$ajaxPrefixPermissaoSubmodulo}}/" + $('#registro_id').val(),
                                beforeSend: function () {
                                    //Retirar DIV Botões e colocar DIV Loading
                                    $('#crudFormButtons2').hide();
                                    $('#crudFormAjaxLoading').show();
                                },
                                success: function (response) {
                                    //Lendo dados
                                    if (response.success) {
                                        alertSwal('success', "{{$ajaxNameSubmodulo}}", response.success, 'true', 2000);

                                        //Modal Show/Hide
                                        $('#crudForm').hide();

                                        //Table Show/Hide
                                        $('#crudTable').show();

                                        //Table
                                        tableContent('{{$ajaxPrefixPermissaoSubmodulo}}');
                                    } else if (response.error) {
                                        alertSwal('success', "{{$ajaxNameSubmodulo}}", response.error, 'true', 2000);

                                        //Modal Show/Hide
                                        $('#crudForm').hide();

                                        //Table Show/Hide
                                        $('#crudTable').show();

                                        //Table
                                        tableContent('{{$ajaxPrefixPermissaoSubmodulo}}');
                                    } else if (response.error_permissao) {
                                        alertSwal('warning', "Permissão Negada", '', 'true', 2000);
                                    } else {
                                        alert('Erro interno');
                                    }
                                },
                                error: function (data) {
                                    alert('Erro interno');
                                },
                                complete: function () {
                                    //Retirar DIV Loading e colocar DIV Botões
                                    $('#crudFormAjaxLoading').hide()
                                    $('#crudFormButtons2').show();
                                }
                            });
                        }
                    });
                });

                //Confirm Operacao
                $('#crudFormConfirmOperacao').click(function (e) {
                    e.preventDefault();

                    //Verificar Validação feita com sucesso
                    if ($('#{{$ajaxNameFormSubmodulo}}').valid()) {
                        //Removendo Máscaras
                        removeMask();

                        //Confirm Operacao - Create
                        if ($('#frm_operacao').val() == 'create') {
                            //Settings''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                            @if($ajaxPrefixPermissaoSubmodulo == 'nees')
                                //Tinymce - pegando valor e jogando no campo
                                $('#descricao').val(tinymce.get('descricao').getContent());
                            @endif
                            //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                            $.ajax({
                                data: $('#{{$ajaxNameFormSubmodulo}}').serialize(),
                                url: "{{route($ajaxPrefixPermissaoSubmodulo.'.store')}}",
                                type: "POST",
                                dataType: "json",
                                beforeSend: function () {
                                    //Retirar DIV Botões e colocar DIV Loading
                                    $('#crudFormButtons1').hide();
                                    $('#crudFormAjaxLoading').show();
                                },
                                success: function (response) {
                                    //Lendo dados
                                    if (response.success) {
                                        //Enviar E-mail'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                                        @if($ajaxPrefixPermissaoSubmodulo == 'avaliacoes')
                                            resposta_pergunta_1 = $("input[type=radio][name=resposta_pergunta_1]:checked").val();
                                            if (resposta_pergunta_1 == 1) {resposta_pergunta_1 = 'Sim';}
                                            if (resposta_pergunta_1 == 2) {resposta_pergunta_1 = 'Não';}
                                            if (resposta_pergunta_1 == 3) {resposta_pergunta_1 = 'Parcialmente';}

                                            resposta_pergunta_2 = $("input[type=radio][name=resposta_pergunta_2]:checked").val();
                                            if (resposta_pergunta_2 == 1) {resposta_pergunta_2 = 'Sim';}
                                            if (resposta_pergunta_2 == 2) {resposta_pergunta_2 = 'Não';}
                                            if (resposta_pergunta_2 == 3) {resposta_pergunta_2 = 'Parcialmente';}

                                            resposta_pergunta_3 = $("#resposta_pergunta_3").val();

                                            usuario = '{{$userLoggedData['name'].' ['.$userLoggedData['email'].']'}}';

                                            $.get("enviar_email/avaliacoes/avaliacao/"+resposta_pergunta_1+"/"+resposta_pergunta_2+"/"+resposta_pergunta_3+"/"+usuario);
                                        @endif
                                        //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                                        alertSwal('success', "{{$ajaxNameSubmodulo}}", response.success, 'true', 2000);

                                        //Limpar validações
                                        $('.is-invalid').removeClass('is-invalid');

                                        //Limpar Formulário
                                        $('#{{$ajaxNameFormSubmodulo}}').trigger('reset');

                                        //Modal Show/Hide
                                        $('#crudForm').hide();

                                        //Table Show/Hide
                                        $('#crudTable').show();

                                        //Table
                                        tableContent('{{$ajaxPrefixPermissaoSubmodulo}}');
                                    } else if (response.error_validation) {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        //Montar mensage de erro de Validação
                                        message = '<div class="pt-3">';
                                        $.each(response.error_validation, function (index, value) {
                                            message += '<div class="col-12 text-start font-size-12"><b>></b> ' + value + '</div>';
                                        });
                                        message += '</div>';

                                        alertSwal('warning', "Validação", message, 'true', 20000);
                                    } else if (response.error_permissao) {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        alertSwal('warning', "Permissão Negada", '', 'true', 2000);
                                    } else {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        alert('Erro interno');
                                    }
                                },
                                error: function (data) {
                                    //Removendo Máscaras
                                    removeMask();

                                    //Restaurando Máscaras
                                    putMask();

                                    alert('Erro interno');
                                },
                                complete: function () {
                                    //Retirar DIV Loading e colocar DIV Botões
                                    $('#crudFormAjaxLoading').hide()
                                    $('#crudFormButtons1').show();
                                }
                            });
                        }

                        //Confirm Operacao - Edit
                        if ($('#frm_operacao').val() == 'edit') {
                            //Settings''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                            @if($ajaxPrefixPermissaoSubmodulo == 'nees')
                                //Tinymce - pegando valor e jogando no campo
                                $('#descricao').val(tinymce.get('descricao').getContent());
                            @endif
                            //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                            $.ajax({
                                data: $('#{{$ajaxNameFormSubmodulo}}').serialize(),
                                url: "{{$ajaxPrefixPermissaoSubmodulo}}/"+$('#registro_id').val(),
                                type: "PUT",
                                dataType: "json",
                                beforeSend: function () {
                                    //Retirar DIV Botões e colocar DIV Loading
                                    $('#crudFormButtons1').hide();
                                    $('#crudFormAjaxLoading').show();
                                },
                                success: function (response) {
                                    //Lendo dados
                                    if (response.success) {
                                        alertSwal('success', "{{$ajaxNameSubmodulo}}", response.success, 'true', 2000);

                                        //Limpar validações
                                        $('.is-invalid').removeClass('is-invalid');

                                        //Limpar Formulário
                                        $('#{{$ajaxNameFormSubmodulo}}').trigger('reset');

                                        //Modal Show/Hide
                                        $('#crudForm').hide();

                                        //Table Show/Hide
                                        $('#crudTable').show();

                                        //Table
                                        tableContent('{{$ajaxPrefixPermissaoSubmodulo}}');
                                    } else if (response.error_validation) {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        //Montar mensage de erro de Validação
                                        message = '<div class="pt-3">';
                                        $.each(response.error_validation, function (index, value) {
                                            message += '<div class="col-12 text-start font-size-12"><b>></b> ' + value + '</div>';
                                        });
                                        message += '</div>';

                                        alertSwal('warning', "Validação", message, 'true', 20000);
                                    } else if (response.error_not_found) {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        alertSwal('warning', "Registro não encontrado", '', 'true', 2000);
                                    } else if (response.error_permissao) {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        alertSwal('warning', "Permissão Negada", '', 'true', 2000);
                                    } else {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        alert('Erro interno');
                                    }
                                },
                                error: function (data) {
                                    //Removendo Máscaras
                                    removeMask();

                                    //Restaurando Máscaras
                                    putMask();

                                    alert('Erro interno');
                                },
                                complete: function () {
                                    //Retirar DIV Loading e colocar DIV Botões
                                    $('#crudFormAjaxLoading').hide()
                                    $('#crudFormButtons1').show();
                                }
                            });
                        }
                    }
                });

                //Cancel Operacao
                $('.crudFormCancelOperacao').click(function (e) {
                    e.preventDefault();

                    //Modal Show/Hide
                    $('#crudForm').hide();

                    //Table Show/Hide
                    $('#crudTable').show();
                });

                //Configurações'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Select2
                if ($('select').hasClass('select2')) {
                    $(".select2").select2({dropdownParent: $('#crudForm')});
                }

                if ($('select').hasClass('select2-limiting')) {
                    $(".select2-limiting").select2({maximumSelectionLength:2, dropdownParent: $('#crudForm')});
                }

                if ($('select').hasClass('select2-search-disable')) {
                    $(".select2-search-disable").select2({minimumResultsForSearch:1/0, dropdownParent: $('#crudForm')});
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            });
        </script>
    @endif
@endif
