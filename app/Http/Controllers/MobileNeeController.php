<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MobileNeeController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function __construct()
    {
        $this->middleware('check-permissao:mobile_nees_list', ['only' => ['index', 'search']]);
        $this->middleware('check-permissao:mobile_nees_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:mobile_nees_show', ['only' => ['show']]);
        $this->middleware('check-permissao:mobile_nees_edit', ['only' => ['edit', 'update']]);
        $this->middleware('check-permissao:mobile_nees_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 1, 'nees', '', '', '', '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
                //Montar Dados Tabela
                $allData = DataTables::of($this->content)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row, Request $request) {
                        return $this->columnAction($row['id'], $request['ajaxPrefixPermissaoSubmodulo'], $request['userLoggedPermissoes']);
                    })
                    ->rawColumns(['action'])
                    ->escapeColumns([])
                    ->make(true);

                return $allData;
            } else {
                abort(500, 'Erro Interno Client');
            }
        } else {
            return view('mobile.mobile-nees', [
                'evento' => 'index'
            ]);
        }
    }

    public function show($id)
    {
        //Buscando dados Api_Data() - Registro pelo id
        $this->responseApi(1, 2, 'nees', $id, '', '', '');

        //Registro recebido com sucesso
        if ($this->code == 2000) {
            $registro = $this->content;
        } else {
            $registro = '';
        }

        //View
        return view('mobile.mobile-nees', [
            'evento' => 'show',
            'registro' => $registro
        ]);
    }
}
