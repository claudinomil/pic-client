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

            @if ($dashboardsFuncionarios == 1)
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mb-1">
                                    <i class="bx bx-female text-primary display-4"></i>
                                    <p class="h3 text-primary">Funcionários</p>
                                    <h3>{{$content['dashboardsFuncionariosQtd']}}</h3>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
                                <h4>Funções:</h4>
                                <table class="table align-middle table-nowrap">
                                    <tbody>

                                    @foreach($content['dashboardsFuncionariosFuncoes'] as $funcao)
                                        @php
                                            $percentual = ($funcao['qtd'] / $content['dashboardsFuncionariosQtd']) * 100;
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

                                    @foreach($content['dashboardsFuncionariosGeneros'] as $gender)
                                        @php
                                            $percentual = ($gender['qtd'] / $content['dashboardsFuncionariosQtd']) * 100;
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
@endsection
