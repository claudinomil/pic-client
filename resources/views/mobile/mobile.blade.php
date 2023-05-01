@extends('mobile.layouts.layout')

@section('content')
    <div class="row">
        @foreach ($deficiencias as $key => $deficiencia)
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="window.location='{{route('mobile_deficiencias.show', $deficiencia['id'])}}'" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper($deficiencia['name'])}}</button>
            </div>
        @endforeach

            <div class="text-light text-center pt-4 pb-2">CADASTROS</div>

        @foreach ($userLoggedMenuSubmodulosMobile as $key => $dado)
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="window.location='{{route($dado['menu_route'].'.index')}}'" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper($dado['menu_text'])}}</button>
            </div>
        @endforeach

        <!-- MODELO -->
        <!--
        <div class="col-6 px-3 py-2">
            <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
        </div>
        <div class="col-6 px-3 py-2">
            <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
        </div>
        -->

            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Propostas')}}</button>
            </div>
            <div class="col-6 px-3 py-2">
                <button type="button" class="btn btn-dark waves-effect btn-label waves-light font-size-10 col-12 py-3" onclick="alert('Em desenvolvimento.')" style="height: 65px;"><i class="bx bx-loader label-icon "></i> {{mb_strtoupper('Minhas Recargas')}}</button>
            </div>





    </div>
@endsection
