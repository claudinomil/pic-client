<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensagemController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function __construct()
    {
        $this->middleware('check-permissao:mensagens_list', ['only' => ['index', 'atualizar']]);
    }

    public function index(Request $request)
    {
        return view('mensagens.index');
    }

    public function atualizar(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Enviar Mensagem
            $this->responseApi(1, 12, 'mensagens/atualizar', '', '', '', $request->all());

            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else {
                abort(500, 'Erro Interno Conversas');
            }
        }
    }
}
