<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> {{env('APP_NAME')}} | Bem vindo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF-TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @include('layouts.head-css')
    </head>
    <body style="/*background-color: #2a3042;*/">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-1 col-md-2 pt-4 pb-3">&nbsp;</div>
                <div class="col-10 col-md-8 text-center pt-4 pb-3">
                    <img src="{{ asset('build/assets/images/image_logo_pic.png') }}" width="250">
                </div>
                <div class="col-1 col-md-2 pt-4 pb-3 float-end">
                    <form id="frm_login" method="get" action="{{ route('login') }}">
                        @csrf

                        <div class="col-12">
                            <h4 class="text-center">
                                <a class="text-success" href="javascript:frm_login.submit()">Fazer Login</a>
                            </h4>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-6" style="text-align: justify; font-size: 0.8rem;">
                        <p>
                            A plataforma inclusãocolaborativa.com é um produto educacional pensado a partir da  pesquisa sobre Ensino Colaborativo e Práticas Inclusivas do Programa de Mestrado PPGEC da UNIGRANRIO. Esta plataforma destina-se a fomentar o processo de colaboração entre os professores do AEE (Atendimento Educacional Especializado) e os professores do Ensino Regular para reunir e trocar informações sobre os alunos com necessidades educacionais da escola.
                        </p>
                        <p>
                            Nela, os professores poderão estabelecer comunicação e manterem-se informados sobre os alunos atendidos pela Sala de Recursos Multifuncionais e incluídos nas turmas do Ensino Regular em diferentes anos de escolaridade.
                            Trata-se de um espaço digital colaborativo de práticas educacionais inclusivas, que terá como foco central o processo de inclusão dos alunos, bem como a melhoria do seu processo de ensino–aprendizagem. Este local de troca estará disponível para consultas e alimentação pelos professores com: informações sobre os alunos, sequências didáticas, vídeos, sugestão de materiais adaptados de acordo com a especificidade de cada aluno e propostas inclusivas diversas utilizadas pelos professores em suas aulas.
                        </p>
                    </div>
                    <div class="col-6" style="text-align: justify; font-size: 0.8rem;">
                        <p>
                            A utilização deste produto pelos educadores trará a possibilidade de promover: a integração com seus pares e a troca de informações trazendo a possibilidade de reflexão sobre suas estratégias pedagógicas e subsídios para enriquecer suas aulas tornando-as mais significativas, criativas e inclusivas.
                            Acredita-se que  desta forma facilitaremos o processo de inclusão de todos os estudantes em nossas escolas, utilizando a tecnologia como aliada para esta missão.
                            A plataforma Inclusão Colaborativa torna-se dinâmica e em constante construção ao receber e compartilhar ações pedagógicas que promovem a inclusão de estudantes no processo de ensino aprendizagem. Pode-se afirmar que a proposta de trabalho colaborativo aqui iniciada trata-se de um convite para uma caminhada coletiva em direção ao fazer docente mais inclusivo.
                        </p>
                        <div class="col-12 text-center px-1 py-1">
                            <span class="text-white badge bg-dark font-size-16">
                                E você, gostaria de participar deste projeto?
                                <br>
                                <a href="#" class="font-size-12 createPublicoEscola">Clique aqui e cadastre sua Escola.</a>
{{--                                <a href="#modal-publico-escola" class="font-size-12 createPublicoEscola" data-bs-toggle="modal">Clique aqui e cadastre sua Escola.</a>--}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Publico Escola -->
        <div class="modal fade" id="modal-publico-escola" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastre sua Escola</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <form id="frm_publico_escolas" name="frm_publico_escolas" method="post">
                                <div class="row">
                                    <div class="form-group col-12 pb-2">
                                        <label class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required="required">
                                    </div>
                                    <div class="form-group col-6 pb-2">
                                        <label class="form-label">Telefone</label>
                                        <input type="text" class="form-control mask_phone_with_ddd" id="telefone" name="telefone">
                                    </div>
                                    <div class="form-group col-6 pb-2">
                                        <label class="form-label">Celular</label>
                                        <input type="text" class="form-control mask_cell_with_ddd" id="celular" name="celular">
                                    </div>
                                    <div class="form-group col-12 pb-2">
                                        <label class="form-label">Diretor</label>
                                        <input type="text" class="form-control" id="diretor" name="diretor" required="required">
                                    </div>
                                    <div class="form-group col-12 pb-2">
                                        <label class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco" required="required">
                                    </div>
                                    <div class="form-group col-12 pb-2">
                                        <label class="form-label">E-mail</label>
                                        <input type="email" class="form-control mask_email" id="email" name="email">
                                    </div>
                                    <div class="form-group col-12 pb-2">
                                        <label class="form-label">Motivo</label>
                                        <textarea class="form-control" id="motivo" name="motivo"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary publicoEscolaFormConfirmOperacao">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- libs -->
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/bootstrap/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery-mask/jquery.mask.min.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/jquery-masks.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery-validation/jquery-validation.min.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/libs/jquery-validation/jquery-validation-pt-br.js') }}"></script>
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/jquery-validation-methods.js') }}"></script>

        <!-- functions.js -->
        <script type="text/javascript" src="{{ Vite::asset('resources/assets_template/js/functions.js') }}"></script>

        <script>
            $(document).ready(function () {
                if ($('#frm_publico_escolas').length) {
                    $('#frm_publico_escolas').validate({
                        rules: {
                            nome: {
                                required: true,
                                minlength: 3
                            },
                            diretor: {
                                required: true,
                                minlength: 3
                            },
                            email: {
                                required: true,
                                email: true
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

                //Create Publico Escolas
                $(function () {
                    //Header
                    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

                    //Create
                    $('.createPublicoEscola').click(function () {
                        //Limpar validações
                        $('.is-invalid').removeClass('is-invalid');

                        //Limpar Formulário
                        $('#frm_publico_escolas').trigger('reset');

                        //Removendo Máscaras
                        removeMask();

                        //Restaurando Máscaras
                        putMask();

                        //Abrir Modal
                        $('#modal-publico-escola').modal('show');
                    });

                    //Confirm Operacao
                    $('.publicoEscolaFormConfirmOperacao').click(function (e) {
                        e.preventDefault();

                        //Verificar Validação feita com sucesso
                        if ($('#frm_publico_escolas').valid()) {
                            //Removendo Máscaras
                            removeMask();

                            $.ajax({
                                data: $('#frm_publico_escolas').serialize(),
                                url: "{{route('publico_escolas.store')}}",
                                type: "POST",
                                dataType: "json",
                                beforeSend: function () {},
                                success: function (response) {
                                    //Lendo dados
                                    if (response.success) {
                                        //Fechar Modal
                                        $('#modal-publico-escola').modal('hide');

                                        //Mensagem
                                        alertSwal('success', 'Obrigado pelo contato.', 'Escola cadastrada com sucesso', 'true', 4000);

                                        //Enviar E-mail
                                        $.get("enviar_email/publico_escolas/"+$('#nome').val()+"/"+$('#telefone').val()+"/"+$('#diretor').val()+"/"+$('#endereco').val()+"/"+$('#email').val()+"/"+$('#motivo').val());

                                        //Limpar validações
                                        $('.is-invalid').removeClass('is-invalid');

                                        //Limpar Formulário
                                        $('#frm_publico_escolas').trigger('reset');
                                    } else {
                                        //Removendo Máscaras
                                        removeMask();

                                        //Restaurando Máscaras
                                        putMask();

                                        alert('Erro interno');
                                    }
                                },
                                error: function (data) {
                                    //Removendo Máscaras
                                    removeMask();

                                    //Restaurando Máscaras
                                    putMask();

                                    alert('Erro interno');
                                },
                                complete: function () {}
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>
