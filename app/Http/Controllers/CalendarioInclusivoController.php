<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CalendarioInclusivoController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    //Dados Auxiliares

    public function __construct()
    {
        $this->middleware('check-permissao:calendarios_inclusivos_list', ['only' => ['index', 'search']]);
        $this->middleware('check-permissao:calendarios_inclusivos_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:calendarios_inclusivos_show', ['only' => ['show']]);
        $this->middleware('check-permissao:calendarios_inclusivos_edit', ['only' => ['edit', 'update']]);
        $this->middleware('check-permissao:calendarios_inclusivos_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 1, 'calendarios_inclusivos', '', '', '', '');

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
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        } else {
            //Buscando dados Api_Data() - Auxiliary Tables (Combobox)
            $this->responseApi(2, 10, 'calendarios_inclusivos/auxiliary/tables', '', '', '', '');


            //dd($this->generos);

            return view('calendarios_inclusivos.index');
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
            $this->responseApi(1, 4, 'calendarios_inclusivos', '', '', '', $request->all());

            //Registro criado com sucesso
            if ($this->code == 2010) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else {
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        }
    }

    public function show(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'calendarios_inclusivos', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'calendarios_inclusivos', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        }
    }

    public function update(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registro
            $this->responseApi(1, 5, 'calendarios_inclusivos', $id, '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Deletar Registro
            $this->responseApi(1, 6, 'calendarios_inclusivos', $id, '', '', '');

            //Registro deletado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2040) { //Registro não excluído - pertence a relacionamento com outra(s) tabela(s)
                return response()->json(['error' => $this->message]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error' => $this->message]);
            } else {
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        }
    }

    public function search(Request $request, $field = '', $value = '')
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Pesquisar Registros
            $this->responseApi(1, 3, 'calendarios_inclusivos', '', $field, $value, '');

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
                abort(500, 'Erro Interno Calendário Inclusivo');
            }
        } else {
            return view('calendarios_inclusivos.index');
        }
    }

    public function pdf_upload(Request $request, $pdf_upload_descricao)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Variavel controle
            $error = true;
            $message = 'Erro: Upload não realizado, tente novamente.';

            //Verificando se foi selecionado um arquivo
            if ($request->hasFile('pdf_upload_arquivo')) {
                //pegando id do registro
                $id = $request['registro_id'];

                //buscar dados formulario
                $arquivo_tmp = $_FILES['pdf_upload_arquivo']['tmp_name'];
                $arquivo_real = $_FILES['pdf_upload_arquivo']['name'];
                $arquivo_real = utf8_decode($arquivo_real);
                $arquivo_type = $_FILES['pdf_upload_arquivo']['type'];
                $arquivo_size = $_FILES['pdf_upload_arquivo']['size'];

                //verificando se o arquivo selecionado é um pdf
                if ($arquivo_type == 'application/pdf') {
                    //copiando arquivo selecionado
                    if (copy($arquivo_tmp, "build/assets/pdfs/calendarios_inclusivos/$arquivo_real")) {
                        //confirmar se realmente foi copiado para a pasto
                        if (file_exists("build/assets/pdfs/calendarios_inclusivos/" . $arquivo_real)) {
                            //renomear para nome calendario_inclusivo_$id_YmdHis
                            $name = 'calendario_inclusivo_'.$id.'_'.date('YmdHis');
                            $pdf = "build/assets/pdfs/calendarios_inclusivos/".$name.'.'.pathinfo($arquivo_real, PATHINFO_EXTENSION);
                            $de = "build/assets/pdfs/calendarios_inclusivos/$arquivo_real";
                            $pa = $pdf;

                            rename($de, $pa);

                            //confirmar se realmente foi renomeado
                            if (file_exists($pdf)) {
                                $error = false;
                                $message = 'Upload realizado com sucesso.';

                                //Salvar Dados na tabela calendarios_inclusivos_pdfs
                                $data = array();
                                $data['calendario_inclusivo_id'] = $id;
                                $data['name'] = $name;
                                $data['descricao'] = $pdf_upload_descricao;
                                $data['caminho'] = $pdf;

                                //Buscando dados Api_Data() - Incluir Registro
                                $this->responseApi(1, 12, 'calendarios_inclusivos/store/pdfs', '', '', '', $data);
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

    public function deletar_pdf($calendario_inclusivo_pdf_id)
    {
        //Buscando dados Api_Data() - Deletar Registro
        $this->responseApi(1, 6, 'calendarios_inclusivos/deletar_pdf', $calendario_inclusivo_pdf_id, '', '', '');
    }
}
