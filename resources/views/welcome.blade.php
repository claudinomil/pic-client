<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> {{env('APP_NAME')}} | Bem vindo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('layouts.head-css')
    </head>
    <body style="background-color: #2a3042;">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-12 text-center pt-4 pb-3">
                    <img src="{{ asset('build/assets/images/image_logo_pic.png') }}" width="250">
                    <form id="frm_login" method="get" action="{{ route('login') }}">
                        @csrf

                        <div class="col-12">
                            <h2 class="text-center">
                                <a class="text-success" href="javascript:frm_login.submit()">Login</a>
                            </h2>
                        </div>
                    </form>
                </div>
                <div class="text-white" style="text-align: justify; font-size: 0.7rem;">
                    <p>
                        A plataforma inclusãocolaborativa.com é um produto educacional pensado a partir da  pesquisa sobre Ensino Colaborativo e Práticas Inclusivas do Programa de Mestrado PPGEC da UNIGRANRIO. Esta plataforma destina-se a fomentar o processo de colaboração entre os professores do AEE (Atendimento Educacional Especializado) e os professores do Ensino Regular para reunir e trocar informações sobre os alunos com necessidades educacionais da escola.
                    </p>
                    <p>
                        Nela, os professores poderão estabelecer comunicação e manterem-se informados sobre os alunos atendidos pela Sala de Recursos Multifuncionais e incluídos nas turmas do Ensino Regular em diferentes anos de escolaridade.
                    Trata-se de um espaço digital colaborativo de práticas educacionais inclusivas, que terá como foco central o processo de inclusão dos alunos, bem como a melhoria do seu processo de ensino–aprendizagem. Este local de troca estará disponível para consultas e alimentação pelos professores com: informações sobre os alunos, sequências didáticas, vídeos, sugestão de materiais adaptados de acordo com a especificidade de cada aluno e propostas inclusivas diversas utilizadas pelos professores em suas aulas.
                    </p>
                    <p>
                        A utilização deste produto pelos educadores trará a possibilidade de promover: a integração com seus pares e a troca de informações trazendo a possibilidade de reflexão sobre suas estratégias pedagógicas e subsídios para enriquecer suas aulas tornando-as mais significativas, criativas e inclusivas.
                    Acredita-se que  desta forma facilitaremos o processo de inclusão de todos os estudantes em nossas escolas, utilizando a tecnologia como aliada para esta missão.
                    A plataforma Inclusão Colaborativa torna-se dinâmica e em constante construção ao receber e compartilhar ações pedagógicas que promovem a inclusão de estudantes no processo de ensino aprendizagem. Pode-se afirmar que a proposta de trabalho colaborativo aqui iniciada trata-se de um convite para uma caminhada coletiva em direção ao fazer docente mais inclusivo.
                    </p>

                    <h4><span class="badge bg-secondary">E você, gostaria de participar deste projeto?</span></h4>

                </div>
            </div>
        </div>
    </body>
</html>
