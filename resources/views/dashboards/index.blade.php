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
                            <img src="{{$dashboardsUsersDados[0]['avatar']}}" alt="" class="avatar-lg rounded-circle img-thumbnail" id="dashboardsUsersFoto">
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
                                        <p class="mb-0" id="dashboardsUsersNome">{{$dashboardsUsersDados[0]['name']}}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 dropdown ms-2">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bxs-cog align-middle me-1"></i> Filtro
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="overflow: hidden; overflow-y: auto; height: 160px;" id="dashboardsUsersDropdown">

                                        @foreach($dashboardsUsersDados as $dado)
                                            @if($dado['id'] == 0)
                                                <a class="dropdown-item" href="#" onclick="dashboardsUsers(0)">Todos</a>
                                            @else
                                                <a class="dropdown-item" href="#" onclick="dashboardsUsers({{$dado['id']}})">{{$dado['name']}}</a>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Grupos</p>
                                        <h5 class="mb-0" id="dashboardsUsersGrupos">{{$dashboardsUsersDados[0]['quantidade_grupos']}}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Situações</p>
                                        <h5 class="mb-0" id="dashboardsUsersSituacoes">{{$dashboardsUsersDados[0]['quantidade_situacoes']}}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Operações</p>
                                        <h5 class="mb-0" id="dashboardsUsersOperacoes">{{$dashboardsUsersDados[0]['quantidade_operacoes_1']+$dashboardsUsersDados[0]['quantidade_operacoes_2']+$dashboardsUsersDados[0]['quantidade_operacoes_3']}}</h5>
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
                                        <th class="align-middle font-size-12">Usuário</th>
                                        <th class="align-middle font-size-12">Grupo<br>Situação</th>
                                        <th class="align-middle font-size-12">Operações</th>
                                    </tr>
                                    </thead>
                                    <tbody id="dashboardsUsersTabela">

                                        @foreach($dashboardsUsersDados as $dado)
                                            @if($dado['id'] != 0)
                                                <tr>
                                                    <td class="font-size-12">{{$dado['name']}}</td>
                                                    <td class="font-size-12">
                                                        {{$dado['grupo']}}
                                                        <br>

                                                        @if($dado['situacao'] == 'Liberado')<span class="text-success">{{$dado['situacao']}}</span>@endif
                                                        @if($dado['situacao'] == 'Bloqueado')<span class="text-danger">{{$dado['situacao']}}</span>@endif
                                                    </td>
                                                    <td class="font-size-12 text-center">{{$dado['quantidade_operacoes_1']+$dado['quantidade_operacoes_2']+$dado['quantidade_operacoes_3']}}</td>
                                                </tr>
                                            @endif
                                        @endforeach

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
                            <img src="{{$dashboardsProfessoresDados[0]['foto']}}" alt="" class="avatar-lg rounded-circle img-thumbnail" id="dashboardsProfessoresFoto">
                            <div class="col-12 text-center">
                                <a class="text-success font-size-11" href="#" onclick="$('#professores_tabela_detalhes').show(); $('#professores_link_mais_detalhes').hide(); $('#professores_link_menos_detalhes').show();" id="professores_link_mais_detalhes">(+) Detalhes</a>
                                <a class="text-primary font-size-11" href="#" onclick="$('#professores_tabela_detalhes').hide(); $('#professores_link_mais_detalhes').show(); $('#professores_link_menos_detalhes').hide();" id="professores_link_menos_detalhes" style="display: none;">(-) Detalhes</a>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="text-muted">
                                        <h5 class="mb-1">Professores</h5>
                                        <p class="mb-0" id="dashboardsProfessoresNome">{{$dashboardsProfessoresDados[0]['name']}}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 dropdown ms-2">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bxs-cog align-middle me-1"></i> Filtro
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="overflow: hidden; overflow-y: auto; height: 160px;" id="dashboardsProfessoresDropdown">

                                        @foreach($dashboardsProfessoresDados as $dado)
                                            @if($dado['id'] == 0)
                                                <a class="dropdown-item" href="#" onclick="dashboardsProfessores(0)">Todos</a>
                                            @else
                                                <a class="dropdown-item" href="#" onclick="dashboardsProfessores({{$dado['id']}})">{{$dado['name']}}</a>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Escolas</p>
                                        <h5 class="mb-0" id="dashboardsProfessoresEscolas">{{$dashboardsProfessoresDados[0]['quantidade_escolas']}}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Turmas</p>
                                        <h5 class="mb-0" id="dashboardsProfessoresTurmas">{{$dashboardsProfessoresDados[0]['quantidade_turmas']}}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Alunos</p>
                                        <h5 class="mb-0" id="dashboardsProfessoresAlunos">{{$dashboardsProfessoresDados[0]['quantidade_alunos']}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="professores_tabela_detalhes" style="display: none;">
                        <div class="col-12">
                            <hr>
                            <div class="table-responsive mt-2">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="align-middle font-size-12">Professor</th>
                                        <th class="align-middle font-size-12">Escolas</th>
                                        <th class="align-middle font-size-12">Turmas</th>
                                        <th class="align-middle font-size-12">Alunos</th>
                                    </tr>
                                    </thead>
                                    <tbody id="dashboardsProfessoresTabela">

                                        @foreach($dashboardsProfessoresDados as $dado)
                                            @if($dado['id'] != 0)
                                                <tr>
                                                    <td class="font-size-12">{{$dado['name']}}</td>
                                                    <td class="font-size-12"><?php echo $dado['escolas']; ?></td>
                                                    <td class="font-size-12 text-center"><?php echo $dado['turmas']; ?></td>
                                                    <td class="font-size-12 text-center"><?php echo $dado['alunos']; ?></td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- scripts_dashboards.js -->
    <script src="{{ Vite::asset('resources/assets_template/js/scripts_dashboards.js')}}"></script>
@endsection

@section('script-bottom')
@endsection







{{--@extends('layouts.app')--}}

{{--@section('title') Dashboards @endsection--}}

{{--@section('css')--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    @component('components.breadcrumb')--}}
{{--        @section('page_title') {{ \App\Facades\Breadcrumb::getCurrentPageTitle() }} @endsection--}}
{{--    @endcomponent--}}

{{--    <div id="crudTable">--}}
{{--        <div class="row">--}}
{{--            <!-- Usuários -->--}}
{{--            <div class="col-12 col-md-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex">--}}
{{--                            <div class="flex-shrink-0 me-3">--}}
{{--                                <img src="" alt="" class="avatar-lg rounded-circle img-thumbnail" id="dashboardsUsersFoto">--}}
{{--                                <div class="col-12 text-center">--}}
{{--                                    <a class="text-success font-size-11" href="#" onclick="$('#usuarios_tabela_detalhes').show(); $('#usuarios_link_mais_detalhes').hide(); $('#usuarios_link_menos_detalhes').show();" id="usuarios_link_mais_detalhes">(+) Detalhes</a>--}}
{{--                                    <a class="text-primary font-size-11" href="#" onclick="$('#usuarios_tabela_detalhes').hide(); $('#usuarios_link_mais_detalhes').show(); $('#usuarios_link_menos_detalhes').hide();" id="usuarios_link_menos_detalhes" style="display: none;">(-) Detalhes</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="flex-grow-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="flex-grow-1">--}}
{{--                                        <div class="text-muted">--}}
{{--                                            <h5 class="mb-1">Usuários</h5>--}}
{{--                                            <p class="mb-0" id="dashboardsUsersNome"></p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-shrink-0 dropdown ms-2">--}}
{{--                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <i class="bx bxs-cog align-middle me-1"></i> Filtro--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-end" style="overflow: hidden; overflow-y: auto; height: 160px;" id="dashboardsUsersDropdown"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <hr>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-muted text-truncate mb-2">Grupos</p>--}}
{{--                                            <h5 class="mb-0" id="dashboardsUsersGrupos"></h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-muted text-truncate mb-2">Situações</p>--}}
{{--                                            <h5 class="mb-0" id="dashboardsUsersSituacoes"></h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-muted text-truncate mb-2">Operações</p>--}}
{{--                                            <h5 class="mb-0" id="dashboardsUsersOperacoes"></h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div id="usuarios_tabela_detalhes" style="display: none;">--}}
{{--                            <div class="col-12">--}}
{{--                                <hr>--}}
{{--                                <div class="table-responsive mt-2">--}}
{{--                                    <table class="table align-middle table-nowrap mb-0">--}}
{{--                                        <thead class="table-light">--}}
{{--                                            <tr>--}}
{{--                                                <th class="align-middle font-size-12">Usuário</th>--}}
{{--                                                <th class="align-middle font-size-12">Grupo<br>Situação</th>--}}
{{--                                                <th class="align-middle font-size-12">Operações</th>--}}
{{--                                            </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody id="dashboardsUsersTabela"></tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Professores -->--}}
{{--            <div class="col-12 col-md-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex">--}}
{{--                            <div class="flex-shrink-0 me-3">--}}
{{--                                <img src="" alt="" class="avatar-lg rounded-circle img-thumbnail" id="dashboardsProfessoresFoto">--}}
{{--                                <div class="col-12 text-center">--}}
{{--                                    <a class="text-success font-size-11" href="#" onclick="$('#professores_tabela_detalhes').show(); $('#professores_link_mais_detalhes').hide(); $('#professores_link_menos_detalhes').show();" id="professores_link_mais_detalhes">(+) Detalhes</a>--}}
{{--                                    <a class="text-primary font-size-11" href="#" onclick="$('#professores_tabela_detalhes').hide(); $('#professores_link_mais_detalhes').show(); $('#professores_link_menos_detalhes').hide();" id="professores_link_menos_detalhes" style="display: none;">(-) Detalhes</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="flex-grow-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="flex-grow-1">--}}
{{--                                        <div class="text-muted">--}}
{{--                                            <h5 class="mb-1">Professores</h5>--}}
{{--                                            <p class="mb-0" id="dashboardsProfessoresNome"></p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-shrink-0 dropdown ms-2">--}}
{{--                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <i class="bx bxs-cog align-middle me-1"></i> Filtro--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-end" style="overflow: hidden; overflow-y: auto; height: 160px;" id="dashboardsProfessoresDropdown"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <hr>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-muted text-truncate mb-2">Escolas</p>--}}
{{--                                            <h5 class="mb-0" id="dashboardsProfessoresEscolas"></h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-muted text-truncate mb-2">Turmas</p>--}}
{{--                                            <h5 class="mb-0" id="dashboardsProfessoresTurmas"></h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-muted text-truncate mb-2">Alunos</p>--}}
{{--                                            <h5 class="mb-0" id="dashboardsProfessoresAlunos"></h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div id="professores_tabela_detalhes" style="display: none;">--}}
{{--                            <div class="col-12">--}}
{{--                                <hr>--}}
{{--                                <div class="table-responsive mt-2">--}}
{{--                                    <table class="table align-middle table-nowrap mb-0">--}}
{{--                                        <thead class="table-light">--}}
{{--                                        <tr>--}}
{{--                                            <th class="align-middle font-size-12">Professor</th>--}}
{{--                                            <th class="align-middle font-size-12">Escolas</th>--}}
{{--                                            <th class="align-middle font-size-12">Turmas</th>--}}
{{--                                            <th class="align-middle font-size-12">Alunos</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody id="dashboardsProfessoresTabela"></tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@section('script')--}}
{{--    <!-- scripts_dashboards.js -->--}}
{{--    <script src="{{ Vite::asset('resources/assets_template/js/scripts_dashboards.js')}}"></script>--}}
{{--@endsection--}}

{{--@section('script-bottom')--}}
{{--@endsection--}}
