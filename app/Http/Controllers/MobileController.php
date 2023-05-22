<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobileController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    //Dados Auxiliares
    public $nees;

    public function __construct()
    {
        $this->middleware('check-permissao:mobile_list', ['only' => ['index', 'search']]);
        $this->middleware('check-permissao:mobile_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:mobile_show', ['only' => ['show']]);
        $this->middleware('check-permissao:mobile_edit', ['only' => ['edit', 'update']]);
        $this->middleware('check-permissao:mobile_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Buscando dados Api_Data() - Lista de Nees
        $this->responseApi(1, 1, 'nees', '', '', '', '');

        //Dados recebidos com sucesso
        if ($this->code == 2000) {$this->nees = $this->content;} else {$this->nees = [];}

        //View
        return view('mobile.mobile', [
            'nees' => $this->nees
        ]);
    }
}
