$(document).ready(function () {
    if ($('#frm_avaliacoes').length) {
        $('#frm_avaliacoes').validate({
            rules: {
                resposta_pergunta_1: {
                    required: true
                },
                resposta_pergunta_2: {
                    required: true
                },
                resposta_pergunta_3: {
                    required: true
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

    //Campo Textarea: resposta_pergunta_3
    var text_max = $('#resposta_pergunta_3').attr('maxlength');
    $('#count_message').html('0 / ' + text_max );
    $('#resposta_pergunta_3').keyup(function() {
        var text_length = $('#resposta_pergunta_3').val().length;
        var text_remaining = text_max - text_length;
        $('#count_message').html(text_length + ' / ' + text_max);
    });
});
