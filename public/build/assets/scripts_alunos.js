$(document).ready(function () {
    if ($('#frm_alunos').length) {
        $('#frm_alunos').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                data_nascimento: {
                    required: true,
                    dateMethod: true
                },
                genero_id: {
                    required: false,
                    idMethod: true
                },
                turma_id: {
                    required: true,
                    idMethod: true
                },
                data_matricula: {
                    required: true,
                    dateMethod: true
                },
                raca_id: {
                    required: false,
                    idMethod: true
                },
                nacionalidade_id: {
                    required: false,
                    idMethod: true
                },
                naturalidade_id: {
                    required: false,
                    idMethod: true
                },
                pai: {
                    required: false,
                    minlength: 3
                },
                mae: {
                    required: false,
                    minlength: 3
                },
                telefone_pai: {
                    required: false,
                    telephoneMethod: true
                },
                telefone_mae: {
                    required: false,
                    telephoneMethod: true
                },
                cpf: {
                    required: false,
                    cpfMethod: true
                },
                cep: {
                    required: false,
                    cepMethod: true
                },
                numero: {
                    required: false,
                    numberMethod: true
                },
                complemento: {
                    required: false,
                    minlength: 1
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

    //Funções para o formulário'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    $(function () {
        //Header
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        //Update Foto
        $('#buttonUploadAlunoExtraFoto').click(function () {
            //Preparar
            $('#divUploadAlunoExtraFoto').show();
            $('#buttonUploadAlunoExtraFoto').hide();
            $('#buttonUploadAlunoExtraFotoClose').show();
        });

        $('#buttonUploadAlunoExtraFotoClose').click(function () {
            //Preparar
            $('#divUploadAlunoExtraFoto').hide();
            $('#buttonUploadAlunoExtraFoto').show();
            $('#buttonUploadAlunoExtraFotoClose').hide();
        });

        $('#frm_upload_aluno_extra_foto').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#frm-upload-aluno-extra-foto-error').text('');

            $.ajax({
                type:'POST',
                url: '/alunos/uploadfoto',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.error_permissao) {
                        alert(response.error_permissao);
                    } else {
                        alert(response);

                        //colocando a imagem na view
                        var file = $("#aluno_extra_foto_file").get(0).files[0];
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function () {
                                $("#imgImageAlunoExtraFoto").attr("src", reader.result);
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                },
                error: function(response){
                    alert(response);
                    $('#frm-upload-aluno-extra-foto-error').text('Foto inválida!!!');
                }
            });
        });

        //Fazer Upload do Documento
        $('.btn_documento_upload_upload').click(function () {
            let formData = new FormData($('#frm_alunos')[0]);

            //Verificando se digitou o campo Nome do Documento PDF (documento_upload_descricao)
            if ($('#documento_upload_descricao').val() == '') {
                alert('Digite a Descrição para o Documento PDF.');
                return;
            }

            //Ajax
            $.ajax({
                type: 'POST',
                url: '/alunos/documento_upload/'+$('#documento_upload_descricao').val(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.substring(0, 4) != 'Erro') {
                        $('#documento_upload_arquivo').val('');
                        $('#documento_upload_descricao').val('');

                        $('#tbodyDocumentoUpload').html('');

                        montar_grade_documentos_aluno(2);
                    }

                    alert(response);
                },
                error: function (response) {
                    alert(response);
                }
            });
        });
    });
    //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
});
