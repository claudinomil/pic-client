$(document).ready(function () {
    if ($('#frm_sobre_produto').length) {
        $('#frm_sobre_produto').validate({
            rules: {
                descricao: {
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

    //Funções para o formulário'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    $(function () {
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
