@extends('layouts.app')

@section('title') Chat @endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @section('page_title') {{ \App\Facades\Breadcrumb::getCurrentPageTitle() }} @endsection
    @endcomponent

    <div id="crudTable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-8 pb-2">&nbsp;</div>
                                    <div class="col-12 col-md-4 float-end">&nbsp;</div>
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
    <!-- scripts_chat.js -->
    <script src="{{ Vite::asset('resources/assets_template/js/scripts_chat.js')}}"></script>
@endsection

@section('script-bottom')
@endsection
