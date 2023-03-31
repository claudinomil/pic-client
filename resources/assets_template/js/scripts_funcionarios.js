$(document).ready(function () {
    if ($('#frm_funcionarios').length) {
        $('#frm_funcionarios').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                data_nascimento: {
                    required: true,
                    dateMethod: true
                },
                gender_id: {
                    required: true,
                    idMethod: true
                },
                estado_civil_id: {
                    required: false,
                    idMethod: true
                },
                scholarity_id: {
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
                father: {
                    required: false,
                    minlength: 3
                },
                mother: {
                    required: false,
                    minlength: 3
                },
                email: {
                    required: false,
                    email: true
                },
                telephone_1: {
                    required: false,
                    telephoneMethod: true
                },
                telephone_2: {
                    required: false,
                    telephoneMethod: true
                },
                cellular_1: {
                    required: false,
                    cellularMethod: true
                },
                cellular_2: {
                    required: false,
                    cellularMethod: true
                },
                role_id: {
                    required: false,
                    idMethod: true
                },
                data_admissao: {
                    required: true,
                    dateMethod: true
                },
                data_demissao: {
                    required: false,
                    dateMethod: true
                },
                personal_identidade_orgao_id: {
                    required: false,
                    idMethod: true
                },
                personal_identidade_estado_id: {
                    required: false,
                    idMethod: true
                },
                personal_identidade_numero: {
                    required: false,
                    numberMethod: true
                },
                personal_identidade_data_emissao: {
                    required: false,
                    dateMethod: true
                },
                professional_identidade_orgao_id: {
                    required: false,
                    idMethod: true
                },
                professional_identidade_estado_id: {
                    required: false,
                    idMethod: true
                },
                professional_identidade_numero: {
                    required: false,
                    numberMethod: true
                },
                professional_identidade_data_emissao: {
                    required: false,
                    dateMethod: true
                },
                cpf: {
                    required: true,
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

    <!-- Script para Funcionario "Botão Extra" -->
    $(function () {
        //Header
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        //Update Foto'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        $('#buttonUploadFuncionarioExtraFoto').click(function () {
            //Preparar
            $('#divUploadFuncionarioExtraFoto').show();
            $('#buttonUploadFuncionarioExtraFoto').hide();
            $('#buttonUploadFuncionarioExtraFotoClose').show();
        });

        $('#buttonUploadFuncionarioExtraFotoClose').click(function () {
            //Preparar
            $('#divUploadFuncionarioExtraFoto').hide();
            $('#buttonUploadFuncionarioExtraFoto').show();
            $('#buttonUploadFuncionarioExtraFotoClose').hide();
        });

        $('#frm_upload_funcionario_extra_foto').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#frm-upload-funcionario-extra-foto-error').text('');

            $.ajax({
                type:'POST',
                url: '/funcionarios/uploadfoto',
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
                        var file = $("#funcionario_extra_foto_file").get(0).files[0];
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function () {
                                $("#imgImageFuncionarioExtraFoto").attr("src", reader.result);
                                $(".header-profile-user").attr("src", reader.result);
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                },
                error: function(response){
                    alert(response);
                    $('#frm-upload-funcionario-extra-foto-error').text('Foto inválida!!!');
                }
            });
        });
        //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    });
});
