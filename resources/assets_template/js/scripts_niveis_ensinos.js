$(document).ready(function () {
    if ($('#frm_niveis_ensinos').length) {
        $('#frm_niveis_ensinos').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                ordenacao: {
                    required: true,
                    number: true,
                    step: 1
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
