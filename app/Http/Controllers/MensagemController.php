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


//        //Buscando dados Api_Data()
//        $this->responseApi(1, 1, 'mensagens', '', '', '', '');
//
//        //Dados recebidos com sucesso
//        if ($this->code == 2000) {
//            $usuario_logado = $this->content['usuario_logado'];
//            $novas_conversas = $this->content['novas_conversas'];
//
//            return view('mensagens.index', compact('usuario_logado', 'novas_conversas'));
//        } else {
//            abort(500, 'Erro Interno Mensagem');
//        }


    }

    public function atualizar(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Enviar Mensagem
            $this->responseApi(1, 12, 'mensagens/atualizar', '', '', '', $request->all());

            //dd($this->content);

            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else {
                abort(500, 'Erro Interno Conversas');
            }
        }
    }









//    public function ultimas_conversas(Request $request)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Usuários Conversas
//            $this->responseApi(1, 10, 'mensagens/ultimas_conversas', '', '', '', '');
//
//            //Dados recebido com sucesso
//            if ($this->code == 2000) {
//                return response()->json(['success' => $this->content]);
//            } else {
//                return response()->json(['error' => 'Erro nas Usuários Conversas']);
//            }
//        }
//    }
//
//    public function enviar_mensagem(Request $request)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Enviar Mensagem
//            $this->responseApi(1, 12, 'mensagens/enviar_mensagem', '', '', '', $request->all());
//
//            //Registro criado com sucesso
//            if ($this->code == 2010) {
//                return response()->json(['success' => $this->message]);
//            } else if ($this->code == 2020) { //Falha na validação dos dados
//                return response()->json(['error_validation' => $this->validation]);
//            } else {
//                abort(500, 'Erro Interno Conversas');
//            }
//        }
//    }
//
//    public function conversas(Request $request, $remetente_user_id, $destinatario_user_id)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Conversas
//            $this->responseApi(1, 10, 'mensagens/conversas/'.$remetente_user_id.'/'.$destinatario_user_id, '', '', '', '');
//
//            //dd($this->content);
//
//            //Dados recebido com sucesso
//            if ($this->code == 2000) {
//                return response()->json(['success' => $this->content]);
//            } else {
//                return response()->json(['error' => 'Erro nas Conversas']);
//            }
//        }
//    }


//    public function create(Request $request)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            return response()->json(['success' => true]);
//        }
//    }
//
//    public function store(Request $request)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Incluir Registro
//            $this->responseApi(1, 4, 'mensagens', '', '', '', $request->all());
//
//            //Registro criado com sucesso
//            if ($this->code == 2010) {
//                return response()->json(['success' => $this->message]);
//            } else if ($this->code == 2020) { //Falha na validação dos dados
//                return response()->json(['error_validation' => $this->validation]);
//            } else {
//                abort(500, 'Erro Interno Mensagem');
//            }
//        }
//    }
//
//    public function show(Request $request, $id)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Registro pelo id
//            $this->responseApi(1, 2, 'mensagens', $id, '', '', '');
//
//            //Registro recebido com sucesso
//            if ($this->code == 2000) {
//                return response()->json(['success' => $this->content]);
//            } else if ($this->code == 4040) { //Registro não encontrado
//                return response()->json(['error_not_found' => $this->message]);
//            } else {
//                abort(500, 'Erro Interno Mensagem');
//            }
//        }
//    }
//
//    public function edit(Request $request, $id)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Registro pelo id
//            $this->responseApi(1, 2, 'mensagens', $id, '', '', '');
//
//            //Registro recebido com sucesso
//            if ($this->code == 2000) {
//                return response()->json(['success' => $this->content]);
//            } else if ($this->code == 4040) { //Registro não encontrado
//                return response()->json(['error_not_found' => $this->message]);
//            } else {
//                abort(500, 'Erro Interno Mensagem');
//            }
//        }
//    }
//
//    public function update(Request $request, $id)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Alterar Registro
//            $this->responseApi(1, 5, 'mensagens', $id, '', '', $request->all());
//
//            //Registro alterado com sucesso
//            if ($this->code == 2000) {
//                return response()->json(['success' => $this->message]);
//            } else if ($this->code == 2020) { //Falha na validação dos dados
//                return response()->json(['error_validation' => $this->validation]);
//            } else if ($this->code == 4040) { //Registro não encontrado
//                return response()->json(['error_not_found' => $this->message]);
//            } else {
//                abort(500, 'Erro Interno Mensagem');
//            }
//        }
//    }
//
//    public function destroy(Request $request, $id)
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Deletar Registro
//            $this->responseApi(1, 6, 'mensagens', $id, '', '', '');
//
//            //Registro deletado com sucesso
//            if ($this->code == 2000) {
//                return response()->json(['success' => $this->message]);
//            } else if ($this->code == 2040) { //Registro não excluído - pertence a relacionamento com outra(s) tabela(s)
//                return response()->json(['error' => $this->message]);
//            } else if ($this->code == 4040) { //Registro não encontrado
//                return response()->json(['error' => $this->message]);
//            } else {
//                abort(500, 'Erro Interno Mensagem');
//            }
//        }
//    }
//
//    public function search(Request $request, $field = '', $value = '')
//    {
//        //Requisição Ajax
//        if ($request->ajax()) {
//            //Buscando dados Api_Data() - Pesquisar Registros
//            $this->responseApi(1, 3, 'mensagens', '', $field, $value, '');
//
//            //Dados recebidos com sucesso
//            if ($this->code == 2000) {
//                $allData = DataTables::of($this->content)
//                    ->addIndexColumn()
//                    ->addColumn('action', function ($row, Request $request) {
//                        return $this->columnAction($row['id'], $request['ajaxPrefixPermissaoSubmodulo'], $request['userLoggedPermissoes']);
//                    })
//                    ->rawColumns(['action'])
//                    ->escapeColumns([])
//                    ->make(true);
//
//                return $allData;
//            } else {
//                abort(500, 'Erro Interno Mensagem');
//            }
//        } else {
//            return view('mensagens.index');
//        }
//    }





}
