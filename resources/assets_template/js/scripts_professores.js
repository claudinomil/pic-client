$(document).ready(function () {
    if ($('#frm_professores').length) {
        $('#frm_professores').validate({
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
                    required: true,
                    idMethod: true
                },
                estado_civil_id: {
                    required: false,
                    idMethod: true
                },
                escolaridade_id: {
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
                email: {
                    required: false,
                    email: true
                },
                telefone_1: {
                    required: false,
                    telephoneMethod: true
                },
                telefone_2: {
                    required: false,
                    telephoneMethod: true
                },
                cellular_1: {
                    required: false,
                    cellularMethod: true
                },
                celular_2: {
                    required: false,
                    cellularMethod: true
                },
                role_id: {
                    required: false,
                    idMethod: true
                },
                data_admissao: {
                    required: false,
                    dateMethod: true
                },
                data_demissao: {
                    required: false,
                    dateMethod: true
                },
                profissional_identidade_orgao_id: {
                    required: false,
                    idMethod: true
                },
                profissional_identidade_estado_id: {
                    required: false,
                    idMethod: true
                },
                profissional_identidade_numero: {
                    required: false,
                    numberMethod: true
                },
                profissional_identidade_data_emissao: {
                    required: false,
                    dateMethod: true
                },
                cpf: {
                    required: false,
                    cpfMethod: true
                },
                pis: {
                    required: false,
                    pisMethod: true
                },
                pasep: {
                    required: false,
                    pasepMethod: true
                },
                carteira_trabalho: {
                    required: false,
                    carteira_trabalhoMethod: true
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

    <!-- Script para Professor "Botão Extra" -->
    $(function () {
        //Header
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        //Update Foto'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        $('#buttonUploadProfessorExtraFoto').click(function () {
            //Preparar
            $('#divUploadProfessorExtraFoto').show();
            $('#buttonUploadProfessorExtraFoto').hide();
            $('#buttonUploadProfessorExtraFotoClose').show();
        });

        $('#buttonUploadProfessorExtraFotoClose').click(function () {
            //Preparar
            $('#divUploadProfessorExtraFoto').hide();
            $('#buttonUploadProfessorExtraFoto').show();
            $('#buttonUploadProfessorExtraFotoClose').hide();
        });

        $('#frm_upload_professor_extra_foto').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#frm-upload-professor-extra-foto-error').text('');

            $.ajax({
                type:'POST',
                url: '/professores/uploadfoto',
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
                        var file = $("#professor_extra_foto_file").get(0).files[0];
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function () {
                                $("#imgImageProfessorExtraFoto").attr("src", reader.result);
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                },
                error: function(response){
                    alert(response);
                    $('#frm-upload-professor-extra-foto-error').text('Foto inválida!!!');
                }
            });
        });
        //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    });
});
