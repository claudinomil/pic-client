@extends('layouts.app')

@section('title') Dashboards @endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @section('page_title') {{ \App\Facades\Breadcrumb::getCurrentPageTitle() }} @endsection
    @endcomponent

    <div id="crudTable">
        <div class="row">

            <!-- Usuários -->
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{$content['dashboardsUsersRegistro']['avatar']}}" alt="" class="avatar-lg rounded-circle img-thumbnail" id="dashboardsUsersFoto">
                                <div class="col-12 text-center">
                                    <a class="text-success font-size-11" href="#" onclick="$('#usuarios_tabela_detalhes').show(); $('#usuarios_link_mais_detalhes').hide(); $('#usuarios_link_menos_detalhes').show();" id="usuarios_link_mais_detalhes">(+) Detalhes</a>
                                    <a class="text-primary font-size-11" href="#" onclick="$('#usuarios_tabela_detalhes').hide(); $('#usuarios_link_mais_detalhes').show(); $('#usuarios_link_menos_detalhes').hide();" id="usuarios_link_menos_detalhes" style="display: none;">(-) Detalhes</a>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="text-muted">
                                            <h5 class="mb-1">Usuários</h5>
                                            <p class="mb-0" id="dashboardsUsersNome">{{$content['dashboardsUsersRegistro']['name']}}</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 dropdown ms-2">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bxs-cog align-middle me-1"></i> Filtro
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="overflow: hidden; overflow-y: auto; height: 160px;">
                                            <a class="dropdown-item" href="#" onclick="dashboardsUsers('0')">Todos</a>

                                            @foreach($content['dashboardsUsersDropdown'] as $registro)
                                                <a class="dropdown-item" href="#" onclick="dashboardsUsers('{{$registro['id']}}')">{{$registro['name']}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Grupos</p>
                                            <h5 class="mb-0" id="dashboardsUsersQtdGrupos">{{$content['dashboardsUsersRegistro']['quantidade_grupos']}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Situações</p>
                                            <h5 class="mb-0" id="dashboardsUsersQtdSituacoes">{{$content['dashboardsUsersRegistro']['quantidade_situacoes']}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Operações</p>
                                            <h5 class="mb-0" id="dashboardsUsersQtdOperacoes">{{$content['dashboardsUsersRegistro']['quantidade_operacoes']}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="usuarios_tabela_detalhes" style="display: none;">
                            <div class="col-12">
                                <hr>
                                <div class="table-responsive mt-2">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="align-middle font-size-12">Usuários</th>
                                                <th class="align-middle font-size-12">Grupos</th>
                                                <th class="align-middle font-size-12">Situações</th>
                                                <th class="align-middle font-size-12">Operações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usuarios_tabela_linhas">
{{--                                            <tr>--}}
{{--                                                <td class="font-size-12">Claudino Mil Homens de Moraes</td>--}}
{{--                                                <td class="font-size-12 text-center">7</td>--}}
{{--                                                <td class="font-size-12 text-center">8</td>--}}
{{--                                                <td class="font-size-12 text-center">1</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td class="font-size-12">Claudino Mil Homens de Moraes</td>--}}
{{--                                                <td class="font-size-12 text-center">7</td>--}}
{{--                                                <td class="font-size-12 text-center">8</td>--}}
{{--                                                <td class="font-size-12 text-center">1</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td class="font-size-12">Claudino Mil Homens de Moraes</td>--}}
{{--                                                <td class="font-size-12 text-center">7</td>--}}
{{--                                                <td class="font-size-12 text-center">8</td>--}}
{{--                                                <td class="font-size-12 text-center">1</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td class="font-size-12">Claudino Mil Homens de Moraes</td>--}}
{{--                                                <td class="font-size-12 text-center">7</td>--}}
{{--                                                <td class="font-size-12 text-center">8</td>--}}
{{--                                                <td class="font-size-12 text-center">1</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td class="font-size-12">Claudino Mil Homens de Moraes</td>--}}
{{--                                                <td class="font-size-12 text-center">7</td>--}}
{{--                                                <td class="font-size-12 text-center">8</td>--}}
{{--                                                <td class="font-size-12 text-center">1</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td class="font-size-12">Claudino Mil Homens de Moraes</td>--}}
{{--                                                <td class="font-size-12 text-center">7</td>--}}
{{--                                                <td class="font-size-12 text-center">8</td>--}}
{{--                                                <td class="font-size-12 text-center">1</td>--}}
{{--                                            </tr>--}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>







                    </div>
                </div>
            </div>

            <!-- Professores -->
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{$content['dashboardsProfessoresRegistro']['foto']}}" alt="" class="avatar-lg rounded-circle img-thumbnail" id="dashboardsProfessoresFoto">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="text-muted">
                                            <h5 class="mb-1">Professores</h5>
                                            <p class="mb-0" id="dashboardsProfessoresNome">{{$content['dashboardsProfessoresRegistro']['name']}}</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 dropdown ms-2">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bxs-cog align-middle me-1"></i> Filtro
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="overflow: hidden; overflow-y: auto; height: 160px;">
                                            <a class="dropdown-item" href="#" onclick="dashboardsProfessores('0')">Todos</a>

                                            @foreach($content['dashboardsProfessoresDropdown'] as $registro)
                                                <a class="dropdown-item" href="#" onclick="dashboardsProfessores('{{$registro['id']}}')">{{$registro['name']}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Escolas</p>
                                            <h5 class="mb-0" id="dashboardsProfessoresQtdEscolas">{{$content['dashboardsProfessoresRegistro']['quantidade_escolas']}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Turmas</p>
                                            <h5 class="mb-0" id="dashboardsProfessoresQtdTurmas">{{$content['dashboardsProfessoresRegistro']['quantidade_turmas']}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Alunos</p>
                                            <h5 class="mb-0" id="dashboardsProfessoresQtdAlunos">{{$content['dashboardsProfessoresRegistro']['quantidade_alunos']}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>












            @if ($dashboardsUsers == 1)
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mb-1">
                                    <i class="bx bx-user text-primary display-4"></i>
                                    <p class="h3 text-primary">Usuários</p>
                                    <h3>{{$content['dashboardsUsersQtd']}}</h3>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
                                <h4>Grupos:</h4>
                                <table class="table align-middle table-nowrap">
                                    <tbody>

                                    @foreach($content['dashboardsUsersGrupos'] as $grupo)
                                        @php
                                            $percentual = ($grupo['qtd'] / $content['dashboardsUsersQtd']) * 100;
                                        @endphp

                                        <tr>
                                            <td class="px-0" style="width: 30%"><p class="mb-0">{{$grupo['name']}}</p></td>
                                            <td class="text-end" style="width: 25%"><h5 class="mb-0">{{$grupo['qtd']}}</h5></td>
                                            <td class="px-0" style="width: 30%">
                                                <div class="progress bg-transparent progress-sm">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: {{number_format($percentual, 2, '.', '')}}%" aria-valuenow="{{number_format($percentual, 2, '.', '')}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="px-0" style="width: 15%"><span class="float-end">{{number_format($percentual, 2, '.', '')}}%</span></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <h4>Situações:</h4>
                                <table class="table align-middle table-nowrap">
                                    <tbody>

                                    @foreach($content['dashboardsUsersSituacoes'] as $situacao)
                                        @php
                                            $percentual = ($situacao['qtd'] / $content['dashboardsUsersQtd']) * 100;
                                        @endphp

                                        <tr>
                                            <td class="px-0" style="width: 30%"><p class="mb-0">{{$situacao['name']}}</p></td>
                                            <td class="text-end" style="width: 25%"><h5 class="mb-0">{{$situacao['qtd']}}</h5></td>
                                            <td class="px-0" style="width: 30%">
                                                <div class="progress bg-transparent progress-sm">
                                                    <div class="progress-bar bg-success rounded" role="progressbar" style="width: {{number_format($percentual, 2, '.', '')}}%" aria-valuenow="{{number_format($percentual, 2, '.', '')}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="px-0" style="width: 15%"><span class="float-end">{{number_format($percentual, 2, '.', '')}}%</span></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($dashboardsProfessores == 1)
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mb-1">
                                    <i class="bx bx-female text-primary display-4"></i>
                                    <p class="h3 text-primary">Funcionários</p>
                                    <h3>{{$content['dashboardsProfessoresQtd']}}</h3>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
                                <h4>Funções:</h4>
                                <table class="table align-middle table-nowrap">
                                    <tbody>

                                    @foreach($content['dashboardsProfessoresFuncoes'] as $funcao)
                                        @php
                                            $percentual = ($funcao['qtd'] / $content['dashboardsProfessoresQtd']) * 100;
                                        @endphp

                                        <tr>
                                            <td class="px-0" style="width: 30%"><p class="mb-0">{{$funcao['name']}}</p></td>
                                            <td class="text-end" style="width: 25%"><h5 class="mb-0">{{$funcao['qtd']}}</h5></td>
                                            <td class="px-0" style="width: 30%">
                                                <div class="progress bg-transparent progress-sm">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: {{number_format($percentual, 2, '.', '')}}%" aria-valuenow="{{number_format($percentual, 2, '.', '')}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="px-0" style="width: 15%"><span class="float-end">{{number_format($percentual, 2, '.', '')}}%</span></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <h4>Gêneros:</h4>
                                <table class="table align-middle table-nowrap">
                                    <tbody>

                                    @foreach($content['dashboardsProfessoresGeneros'] as $gender)
                                        @php
                                            $percentual = ($gender['qtd'] / $content['dashboardsProfessoresQtd']) * 100;
                                        @endphp

                                        <tr>
                                            <td class="px-0" style="width: 30%"><p class="mb-0">{{$gender['name']}}</p></td>
                                            <td class="text-end" style="width: 25%"><h5 class="mb-0">{{$gender['qtd']}}</h5></td>
                                            <td class="px-0" style="width: 30%">
                                                <div class="progress bg-transparent progress-sm">
                                                    <div class="progress-bar bg-success rounded" role="progressbar" style="width: {{number_format($percentual, 2, '.', '')}}%" aria-valuenow="{{number_format($percentual, 2, '.', '')}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="px-0" style="width: 15%"><span class="float-end">{{number_format($percentual, 2, '.', '')}}%</span></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('script')
    <!-- scripts_dashboards.js -->
    <script src="{{ Vite::asset('resources/assets_template/js/scripts_dashboards.js')}}"></script>
@endsection

@section('script-bottom')
@endsection
