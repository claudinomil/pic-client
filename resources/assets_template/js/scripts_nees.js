$(document).ready(function () {
    if ($('#frm_nees').length) {
        $('#frm_nees').validate({
            rules: {
                name: {
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
        $('.btn_documento_upload_upload').click(function () {
            let formData = new FormData($('#frm_nees')[0]);

            //Verificando se digitou o campo Nome do Documento PDF (documento_upload_descricao)
            if ($('#documento_upload_descricao').val() == '') {
                alert('Digite a Descrição para o Documento PDF.');
                return;
            }

            //Ajax
            $.ajax({
                type: 'POST',
                url: '/nees/documento_upload/'+$('#documento_upload_descricao').val(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.substring(0, 4) != 'Erro') {
                        $('#documento_upload_arquivo').val('');
                        $('#documento_upload_descricao').val('');

                        $('#tbodyDocumentoUpload').html('');

                        montar_grade_documentos_nee(2);
                    }

                    alert(response);
                },
                error: function (response) {
                    alert(response);
                }
            });
        });

        //Campo descricao (Tinymce)
        $("#descricao").length && tinymce.init({
            selector: "textarea#descricao",
            height: 600,
            //plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
            plugins: [""],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {
                    title: "Bold text",
                    inline: "b"
                }, {
                    title: "Red text",
                    inline: "span",
                    styles: {
                        color: "#ff0000"
                    }
                }, {
                    title: "Red header",
                    block: "h1",
                    styles: {
                        color: "#ff0000"
                    }
                }, {
                    title: "Example 1",
                    inline: "span",
                    classes: "example1"
                }, {
                    title: "Example 2",
                    inline: "span",
                    classes: "example2"
                }, {
                    title: "Table styles"
                }, {
                    title: "Table row 1",
                    selector: "tr",
                    classes: "tablerow1"
                }
            ]
        });
    });
    //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
});
