$(document).ready(function () {
    if ($('#frm_calendarios_inclusivos').length) {
        $('#frm_calendarios_inclusivos').validate({
            rules: {
                data_evento: {
                    required: true,
                    dateMethod: true
                },
                evento: {
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

    //Funções para o formulário'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    $(function () {
        //Header
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        //Fazer Upload do Documento
        $('.btn_pdf_upload_upload').click(function () {
            let formData = new FormData($('#frm_calendarios_inclusivos')[0]);

            //Verificando se digitou o campo Nome do Documento PDF (pdf_upload_descricao)
            if ($('#pdf_upload_descricao').val() == '') {
                alert('Digite a Descrição para o Documento PDF.');
                return;
            }

            //Ajax
            $.ajax({
                type: 'POST',
                url: '/calendarios_inclusivos/pdf_upload/'+$('#pdf_upload_descricao').val(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.substring(0, 4) != 'Erro') {
                        $('#pdf_upload_arquivo').val('');
                        $('#pdf_upload_descricao').val('');

                        $('#tbodyPdfUpload').html('');

                        montar_grade_pdfs_calendario(2);
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
