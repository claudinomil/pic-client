$(document).ready(function () {
    if ($('#frm_escolas').length) {
        $('#frm_escolas').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                tipo_escola_id: {
                    required: true,
                    idMethod: true
                },
                telefone_1: {
                    required: false,
                    telephoneMethod: true
                },
                telefone_2: {
                    required: false,
                    telephoneMethod: true
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
});
