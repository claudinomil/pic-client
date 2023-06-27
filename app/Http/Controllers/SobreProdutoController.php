<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreProdutoController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function __construct()
    {
        $this->middleware('check-permissao:sobre_produto_list', ['only' => ['index']]);
        $this->middleware('check-permissao:sobre_produto_edit', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'sobre_produto', 1, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                $registro = $this->content;
            } else if ($this->code == 4040) { //Registro não encontrado
                $registro = [];
            } else {
                abort(500, 'Erro Interno Sobre o Produto Educacional');
            }

            return view('sobre_produto.index', compact('registro'));
        } else {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'sobre_produto', 1, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                $registro = $this->content;
            } else if ($this->code == 4040) { //Registro não encontrado
                $registro = [];
            } else {
                abort(500, 'Erro Interno Sobre o Produto Educacional');
            }

            return view('sobre_produto.index', compact('registro'));
        }
    }

    public function edit(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'sobre_produto', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Sobre o Produto Educacional');
            }
        }
    }

    public function update(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registro
            $this->responseApi(1, 5, 'sobre_produto', $id, '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Sobre o Produto Educacional');
            }
        }
    }
}
