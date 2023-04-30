@extends('mobile.layouts.layout')

@section('content')
    <div id="crudTable">

        <div class="bg-white rounded py-2 px-2" style="min-height: 400px;">
            <!-- Botoes -->
            <div class="row">
                <div class="col-12 col-md-8 pb-2"></div>
            </div>

            @if($evento == 'index')
                <!-- Tabela (Componente Blade) -->
                @php
                    $colsNames = ['Nome'];
                    $colsFields = ['name'];
                    $colActions = 'no';
                @endphp

                <div class="pt-1">
                    <x-table-mobile-ajax
                        :numCols="2"
                        :class="'table table-dark table-bordered mb-0 nowrap font-size-10'"
                        :colsNames=$colsNames
                        :colsFields=$colsFields
                        :colActions=$colActions />
                </div>
            @endif

            @if($evento == 'show')
                <h6 class="text-center fw-bold px-3">{!! mb_strtoupper($registro['name']) !!}</h6>
                <div class="py-2 px-2">{!! $registro['descricao'] !!}</div>
            @endif
        </div>

    </div>
@endsection
