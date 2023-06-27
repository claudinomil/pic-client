<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EspacoColaboracaoController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    //Dados Auxiliares
    public $alunos;
    public $professores;
    public $alunos_turmas_professores;

    public function __construct()
    {
        $this->middleware('check-permissao:espacos_colaboracoes_list', ['only' => ['index', 'search']]);
        $this->middleware('check-permissao:espacos_colaboracoes_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:espacos_colaboracoes_show', ['only' => ['show']]);
        $this->middleware('check-permissao:espacos_colaboracoes_edit', ['only' => ['edit', 'update']]);
        $this->middleware('check-permissao:espacos_colaboracoes_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 1, 'espacos_colaboracoes', '', '', '', '');

            $registros = $this->content;

            //Filtro para mostrar na grade (Aluno x Professor)'''''''''''''''''''''''''''''''''''''
            if ($request['userLoggedPermissao_apenas_alunos_professor_logado'] == 1) {
                $alunos = $request['userLoggedProfessor_alunos'];

                $index = 0;
                foreach ($registros as $registro) {
                    $retirar = 1;

                    //Verificar array alunos
                    foreach ($alunos as $aluno) {
                        if ($registro['aluno_id'] == $aluno['id']) {
                            $retirar = 0;
                        }
                    }

                    if ($retirar == 1) {unset($registros[$index]);}

                    $index++;
                }
            }
            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
                $allData = DataTables::of($registros)
                    ->addIndexColumn()
                    ->editColumn('data_hora', function ($row) {
                        $data = $row['data'];
                        $hora = substr($row['hora'], 0, 5);

                        $retorno = "<h5 class='text-truncate font-size-14'>".$data."</h5>";
                        $retorno .= "<p class='text-muted mb-0'>".$hora."</p>";

                        return $retorno;
                    })
                    ->addColumn('action', function ($row, Request $request) {
                        return $this->columnAction($row['id'], $request['ajaxPrefixPermissaoSubmodulo'], $request['userLoggedPermissoes']);
                    })
                    ->rawColumns(['action'])
                    ->escapeColumns([])
                    ->make(true);

                return $allData;
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        } else {
            //Buscando dados Api_Data() - Auxiliary Tables (Combobox)
            $this->responseApi(2, 10, 'espacos_colaboracoes/auxiliary/tables', '', '', '', '');

            return view('espacos_colaboracoes.index', [
                'alunos' => $this->alunos,
                'professores' => $this->professores,
                'alunos_turmas_professores' => $this->alunos_turmas_professores
            ]);
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
            $this->responseApi(1, 4, 'espacos_colaboracoes', '', '', '', $request->all());

            //Registro criado com sucesso
            if ($this->code == 2010) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        }
    }

    public function show(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'espacos_colaboracoes', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'espacos_colaboracoes', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        }
    }

    public function update(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registro
            $this->responseApi(1, 5, 'espacos_colaboracoes', $id, '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Deletar Registro
            $this->responseApi(1, 6, 'espacos_colaboracoes', $id, '', '', '');

            //Registro deletado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2040) { //Registro não excluído - pertence a relacionamento com outra(s) tabela(s)
                return response()->json(['error' => $this->message]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error' => $this->message]);
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        }
    }

    public function search(Request $request, $field = '', $value = '')
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Pesquisar Registros
            $this->responseApi(1, 3, 'espacos_colaboracoes', '', $field, $value, '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
                $allData = DataTables::of($this->content)
                    ->addIndexColumn()
                    ->editColumn('data_hora', function ($row) {
                        $data = $row['data'];
                        $hora = substr($row['hora'], 0, 5);

                        $retorno = "<h5 class='text-truncate font-size-14'>".$data."</h5>";
                        $retorno .= "<p class='text-muted mb-0'>".$hora."</p>";

                        return $retorno;
                    })
                    ->addColumn('action', function ($row, Request $request) {
                        return $this->columnAction($row['id'], $request['ajaxPrefixPermissaoSubmodulo'], $request['userLoggedPermissoes']);
                    })
                    ->rawColumns(['action'])
                    ->escapeColumns([])
                    ->make(true);

                return $allData;
            } else {
                abort(500, 'Erro Interno Espaço Colaboração');
            }
        } else {
            return view('espacos_colaboracoes.index');
        }
    }
}
