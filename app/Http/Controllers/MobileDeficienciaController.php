<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MobileDeficienciaController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function __construct()
    {
        $this->middleware('check-permissao:mobile_deficiencias_list', ['only' => ['index', 'search']]);
        $this->middleware('check-permissao:mobile_deficiencias_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:mobile_deficiencias_show', ['only' => ['show']]);
        $this->middleware('check-permissao:mobile_deficiencias_edit', ['only' => ['edit', 'update']]);
        $this->middleware('check-permissao:mobile_deficiencias_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 1, 'deficiencias', '', '', '', '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
                //Montar Dados Tabela
                $allData = DataTables::of($this->content)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row, Request $request) {
                        return $this->columnAction($row['id'], $request['userLoggedPermissoes']);
                    })
                    ->rawColumns(['action'])
                    ->escapeColumns([])
                    ->make(true);

                return $allData;
            } else {
                abort(500, 'Erro Interno Client');
            }
        } else {
            return view('mobile.mobile-deficiencias', [
                'evento' => 'index'
            ]);
        }
    }

    public function show($id)
    {
        //Buscando dados Api_Data() - Registro pelo id
        $this->responseApi(1, 2, 'deficiencias', $id, '', '', '');

        //Registro recebido com sucesso
        if ($this->code == 2000) {
            $registro = $this->content;
        } else {
            $registro = '';
        }

        //View
        return view('mobile.mobile-deficiencias', [
            'evento' => 'show',
            'registro' => $registro
        ]);
    }
}
