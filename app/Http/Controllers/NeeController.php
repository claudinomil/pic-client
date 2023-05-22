<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NeeController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function __construct()
    {
        $this->middleware('check-permissao:nees_list', ['only' => ['index', 'search']]);
        $this->middleware('check-permissao:nees_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:nees_show', ['only' => ['show']]);
        $this->middleware('check-permissao:nees_edit', ['only' => ['edit', 'update']]);
        $this->middleware('check-permissao:nees_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 1, 'nees', '', '', '', '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
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
                abort(500, 'Erro Interno Nees');
            }
        } else {
            //Buscando dados Api_Data() - Auxiliary Tables (Combobox)
            $this->responseApi(2, 10, 'nees/auxiliary/tables', '', '', '', '');

            return view('nees.index');
        }
    }

    public function create(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
    }

    public function store(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Incluir Registro
            $this->responseApi(1, 4, 'nees', '', '', '', $request->all());

            //Registro criado com sucesso
            if ($this->code == 2010) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else {
                abort(500, 'Erro Interno Nee');
            }
        }
    }

    public function show(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'nees', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Nee');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'nees', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Nee');
            }
        }
    }

    public function update(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registro
            $this->responseApi(1, 5, 'nees', $id, '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Nee');
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Deletar Registro
            $this->responseApi(1, 6, 'nees', $id, '', '', '');

            //Registro deletado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2040) { //Registro não excluído - pertence a relacionamento com outra(s) tabela(s)
                return response()->json(['error' => $this->message]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error' => $this->message]);
            } else {
                abort(500, 'Erro Interno Nee');
            }
        }
    }

    public function search(Request $request, $field = '', $value = '')
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Pesquisar Registros
            $this->responseApi(1, 3, 'nees', '', $field, $value, '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
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
                abort(500, 'Erro Interno Nee');
            }
        } else {
            return view('nees.index');
        }
    }

    public function documento_upload(Request $request, $documento_upload_descricao)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Variavel controle
            $error = true;
            $message = 'Erro: Upload não realizado, tente novamente.';

            //Verificando se foi selecionado um arquivo
            if ($request->hasFile('documento_upload_arquivo')) {
                //pegando id do registro
                $id = $request['registro_id'];

                //buscar dados formulario
                $arquivo_tmp = $_FILES['documento_upload_arquivo']['tmp_name'];
                $arquivo_real = $_FILES['documento_upload_arquivo']['name'];
                $arquivo_real = utf8_decode($arquivo_real);
                $arquivo_type = $_FILES['documento_upload_arquivo']['type'];
                $arquivo_size = $_FILES['documento_upload_arquivo']['size'];

                //verificando se o arquivo selecionado é um pdf
                if ($arquivo_type == 'application/pdf') {
                    //copiando arquivo selecionado
                    if (copy($arquivo_tmp, "build/assets/pdfs/nees/$arquivo_real")) {
                        //confirmar se realmente foi copiado para a pasto
                        if (file_exists("build/assets/pdfs/nees/" . $arquivo_real)) {
                            //renomear para nome nee_$id_YmdHis
                            $name = 'nee_'.$id.'_'.date('YmdHis');
                            $pdf = "build/assets/pdfs/nees/".$name.'.'.pathinfo($arquivo_real, PATHINFO_EXTENSION);
                            $de = "build/assets/pdfs/nees/$arquivo_real";
                            $pa = $pdf;

                            rename($de, $pa);

                            //confirmar se realmente foi renomeado
                            if (file_exists($pdf)) {
                                $error = false;
                                $message = 'Upload realizado com sucesso.';

                                //Salvar Dados na tabela nees_documentos
                                $data = array();
                                $data['nee_id'] = $id;
                                $data['name'] = $name;
                                $data['descricao'] = $documento_upload_descricao;
                                $data['caminho'] = $pdf;

                                //Buscando dados Api_Data() - Incluir Registro
                                $this->responseApi(1, 12, 'nees/store/documentos', '', '', '', $data);
                            }
                        }
                    }
                } else {
                    $message = 'Erro: Arquivo não é PDF';
                }
            } else {
                $message = 'Erro: Escolha um arquivo PDF';
            }

            //Retornar
            echo $message;
        }
    }

    public function deletar_documento($nee_documento_id)
    {
        //Buscando dados Api_Data() - Deletar Registro
        $this->responseApi(1, 6, 'nees/deletar_documento', $nee_documento_id, '', '', '');
    }
}
