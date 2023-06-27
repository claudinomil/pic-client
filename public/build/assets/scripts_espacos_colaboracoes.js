$(document).ready(function () {
    if ($('#frm_espacos_colaboracoes').length) {
        $('#frm_espacos_colaboracoes').validate({
            rules: {
                aluno_id: {
                    required: true,
                    idMethod: true
                },
                professor_id: {
                    required: true,
                    idMethod: true
                },
                data: {
                    required: true,
                    dateMethod: true
                },
                hora: {
                    required: true
                },
                observacao_resumo: {
                    required: true,
                    minlength: 3,
                    maxlength:100
                },
                observacao: {
                    required: true,
                    minlength: 3,
                    maxlength:1000
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
    //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
});
