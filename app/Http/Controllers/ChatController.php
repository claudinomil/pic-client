<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function usuario_logado(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Usuário Logado
            $this->responseApi(1, 10, 'chat/usuario_logado', '', '', '', '');

            dd($this->content);

            //Dados recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else {
                return response()->json(['error' => 'Usuário logado não foi encontrado']);
            }
        }
    }

    public function novas_conversas(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - NovasConversas
            $this->responseApi(1, 10, 'chat/novas_conversas', '', '', '', '');

            //Dados recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else {
                return response()->json(['error' => 'Erro nos NovasConversas']);
            }
        }
    }

    public function ultimas_conversas(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Usuários Conversas
            $this->responseApi(1, 10, 'chat/ultimas_conversas', '', '', '', '');

            //Dados recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else {
                return response()->json(['error' => 'Erro nas Usuários Conversas']);
            }
        }
    }

    public function conversas(Request $request, $remetente_user_id, $destinatario_user_id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Conversas
            $this->responseApi(1, 10, 'chat/conversas/'.$remetente_user_id.'/'.$destinatario_user_id, '', '', '', '');

            //dd($this->content);

            //Dados recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else {
                return response()->json(['error' => 'Erro nas Conversas']);
            }
        }
    }

    public function enviar_mensagem(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Enviar Mensagem
            $this->responseApi(1, 12, 'chat/enviar_mensagem', '', '', '', $request->all());

            //Registro criado com sucesso
            if ($this->code == 2010) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else {
                abort(500, 'Erro Interno Conversas');
            }
        }
    }

    public function gravar_como_lida(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registro
            $this->responseApi(1, 11, 'chat/gravar_como_lida/'.$id, '', '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else {
                return response()->json(['error' => $this->message]);
            }
        }
    }

    public function gravar_como_recebidas(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registros
            $this->responseApi(1, 11, 'chat/gravar_como_recebidas', '', '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else {
                return response()->json(['error' => $this->message]);
            }
        }
    }
}
