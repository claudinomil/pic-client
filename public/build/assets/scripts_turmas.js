$(document).ready(function () {
    if ($('#frm_turmas').length) {
        $('#frm_turmas').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                escola_id: {
                    required: true,
                    idMethod: true
                },
                nivel_ensino_id: {
                    required: true,
                    idMethod: true
                },
                professor_id: {
                    required: true,
                    idMethod: true
                },
                quantidade_alunos: {
                    required: true
                },
                sala: {
                    required: true
                },
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
