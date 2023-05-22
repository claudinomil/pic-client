<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlunoController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    //Dados Auxiliares
    public $generos;
    public $racas;
    public $nacionalidades;
    public $naturalidades;
    public $turmas;
    public $nees;

    public function __construct()
    {
        $this->middleware('check-permissao:alunos_list', ['only' => ['index', 'search', 'extradata']]);
        $this->middleware('check-permissao:alunos_create', ['only' => ['create', 'store']]);
        $this->middleware('check-permissao:alunos_show', ['only' => ['show']]);
        $this->middleware('check-permissao:alunos_edit', ['only' => ['edit', 'update', 'uploadfoto']]);
        $this->middleware('check-permissao:alunos_destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 1, 'alunos', '', '', '', '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
                $allData = DataTables::of($this->content)
                    ->addIndexColumn()
                    ->editColumn('foto', function ($row) {
                        $retorno = "<div class='text-center'>";
                        $retorno .= "<img src='".asset($row['foto'])."' alt='' class='img-thumbnail rounded-circle avatar-sm'>";
                        $retorno .= "<br>";
                        $retorno .= "<a href='#' data-bs-toggle='modal' data-bs-target='.modal-aluno' onclick='alunoExtraData(".$row['id'].");'><span class='bg-success badge'><i class='bx bx-user font-size-16 align-middle me-1'></i>Perfil</span></a>";
                        $retorno .= "</div>";

                        return $retorno;
                    })
                    ->editColumn('idade', function ($row) {
                        $retorno = Carbon::parse($row['data_nascimento'])->age;

                        return $retorno;
                    })
                    ->editColumn('escola_turma_professor', function ($row) {
                        $retorno = '<b>'.'> '.'</b>'.$row['escolaName'];
                        $retorno .= '<br>'.'<b>'.'> '.'</b>'.$row['turmaName'];
                        $retorno .= '<br>'.'<b>'.'> '.'</b>'.$row['professorName'];

                        return $retorno;
                    })
                    ->editColumn('alunoNees', function ($row) {
                        $alunoNees = explode('##', $row['alunoNees']);

                        $retorno = '';

                        foreach ($alunoNees as $alunoNee) {
                            if ($retorno != '') {$retorno .= '<br>';}

                            if ($alunoNee != '') {$retorno .= '<b>' . '> ' . '</b>' . $alunoNee;}
                        }

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
                abort(500, 'Erro Interno Alunos');
            }
        } else {
            //Buscando dados Api_Data() - Auxiliary Tables (Combobox)
            $this->responseApi(2, 10, 'alunos/auxiliary/tables', '', '', '', '');

            return view('alunos.index', [
                'generos' => $this->generos,
                'racas' => $this->racas,
                'nacionalidades' => $this->nacionalidades,
                'naturalidades' => $this->naturalidades,
                'turmas' => $this->turmas,
                'nees' => $this->nees
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
            $this->responseApi(1, 4, 'alunos', '', '', '', $request->all());

            //Registro criado com sucesso
            if ($this->code == 2010) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else {
                abort(500, 'Erro Interno Alunos');
            }
        }
    }

    public function show(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'alunos', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Alunos');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 2, 'alunos', $id, '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->content]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Alunos');
            }
        }
    }

    public function update(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Alterar Registro
            $this->responseApi(1, 5, 'alunos', $id, '', '', $request->all());

            //Registro alterado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2020) { //Falha na validação dos dados
                return response()->json(['error_validation' => $this->validation]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error_not_found' => $this->message]);
            } else {
                abort(500, 'Erro Interno Alunos');
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Deletar Registro
            $this->responseApi(1, 6, 'alunos', $id, '', '', '');

            //Registro deletado com sucesso
            if ($this->code == 2000) {
                return response()->json(['success' => $this->message]);
            } else if ($this->code == 2040) { //Registro não excluído - pertence a relacionamento com outra(s) tabela(s)
                return response()->json(['error' => $this->message]);
            } else if ($this->code == 4040) { //Registro não encontrado
                return response()->json(['error' => $this->message]);
            } else {
                abort(500, 'Erro Interno Alunos');
            }
        }
    }

    public function search(Request $request, $field = '', $value = '')
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Pesquisar Registros
            $this->responseApi(1, 3, 'alunos', '', $field, $value, '');

            //Dados recebidos com sucesso
            if ($this->code == 2000) {
                $allData = DataTables::of($this->content)
                    ->addIndexColumn()
                    ->editColumn('foto', function ($row) {
                        $retorno = "<div class='text-center'>";
                        $retorno .= "<img src='".asset($row['foto'])."' alt='' class='img-thumbnail rounded-circle avatar-sm'>";
                        $retorno .= "<br>";
                        $retorno .= "<a href='#' data-bs-toggle='modal' data-bs-target='.modal-aluno' onclick='alunoExtraData(".$row['id'].");'><span class='bg-success badge'><i class='bx bx-user font-size-16 align-middle me-1'></i>Perfil</span></a>";
                        $retorno .= "</div>";

                        return $retorno;
                    })
                    ->editColumn('data_nascimento', function ($row) {
                        $retorno = date('d/m/Y', strtotime($row['data_nascimento']));

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
                abort(500, 'Erro Interno Alunos');
            }
        } else {
            return view('alunos.index');
        }
    }

    public function uploadfoto(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Variavel controle
            $error = false;

            //Foto padrão do Sistema
            $foto = "build/assets/images/alunos/aluno-0.png";

            //Verificando e fazendo Upload da Foto novo
            if ($request->hasFile('aluno_extra_foto_file')) {
                //aluno_id
                $id = $request['upload_aluno_extra_foto_aluno_id'];

                //buscar dados formulario
                $arquivo_tmp = $_FILES["aluno_extra_foto_file"]["tmp_name"];
                $arquivo_real = $_FILES["aluno_extra_foto_file"]["name"];
                $arquivo_real = utf8_decode($arquivo_real);
                $arquivo_type = $_FILES["aluno_extra_foto_file"]["type"];
                $arquivo_size = $_FILES['aluno_extra_foto_file']['size'];

                if ($arquivo_type == 'image/jpg' or $arquivo_type == 'image/jpeg' or $arquivo_type == 'image/png') {
                    if (copy($arquivo_tmp, "build/assets/images/alunos/$arquivo_real")) {
                        if (file_exists("build/assets/images/alunos/" . $arquivo_real)) {
                            //apagar foto no diretorio
                            if (file_exists('build/assets/images/alunos/aluno-' . $id . '.png')) {
                                unlink('build/assets/images/alunos/aluno-' . $id . '.png');
                            }
                            if (file_exists('build/assets/images/alunos/aluno-' . $id . '.jpg')) {
                                unlink('build/assets/images/alunos/aluno-' . $id . '.jpg');
                            }
                            if (file_exists('build/assets/images/alunos/aluno-' . $id . '.jpeg')) {
                                unlink('build/assets/images/alunos/aluno-' . $id . '.jpeg');
                            }

                            //Gravar novo
                            $foto = "build/assets/images/alunos/aluno-" . $id . '.' . pathinfo($arquivo_real, PATHINFO_EXTENSION);
                            $de = "build/assets/images/alunos/$arquivo_real";
                            $pa = $foto;

                            try {
                                rename($de, $pa);
                            } catch (\Exception $e) {
                                $error = true;
                            }
                        }
                    }
                }
            }

            if (!$error) {
                //Buscando dados Api_Data() - Alterar Registro
                $data = array();
                $data['foto'] = $foto;
                $this->responseApi(1, 11, 'alunos/updatefoto/' . $id, '', '', '', $data);

                echo $this->message;
            } else {
                echo 'Imagem (Nome, Tamanho ou Tipo) inválida.';
            }
        }
    }

    public function extradata(Request $request, $id)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            //Buscando dados Api_Data() - Registro pelo id
            $this->responseApi(1, 10, 'alunos/extradata/' . $id, '', '', '', '');

            //Registro recebido com sucesso
            if ($this->code == 2000) {
                return json_encode($this->content);
            } else if ($this->code == 4040) { //Registro não encontrado
                echo 'Registro não encontrado.';
            } else {
                echo 'Erro Interno Alunos.';
            }
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
                    if (copy($arquivo_tmp, "build/assets/pdfs/alunos/$arquivo_real")) {
                        //confirmar se realmente foi copiado para a pasto
                        if (file_exists("build/assets/pdfs/alunos/" . $arquivo_real)) {
                            //renomear para nome aluno_$id_YmdHis
                            $name = 'aluno_'.$id.'_'.date('YmdHis');
                            $pdf = "build/assets/pdfs/alunos/".$name.'.'.pathinfo($arquivo_real, PATHINFO_EXTENSION);
                            $de = "build/assets/pdfs/alunos/$arquivo_real";
                            $pa = $pdf;

                            rename($de, $pa);

                            //confirmar se realmente foi renomeado
                            if (file_exists($pdf)) {
                                $error = false;
                                $message = 'Upload realizado com sucesso.';

                                //Salvar Dados na tabela alunos_documentos
                                $data = array();
                                $data['aluno_id'] = $id;
                                $data['name'] = $name;
                                $data['descricao'] = $documento_upload_descricao;
                                $data['caminho'] = $pdf;

                                //Buscando dados Api_Data() - Incluir Registro
                                $this->responseApi(1, 12, 'alunos/store/documentos', '', '', '', $data);
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

    public function deletar_documento($aluno_documento_id)
    {
        //Buscando dados Api_Data() - Deletar Registro
        $this->responseApi(1, 6, 'alunos/deletar_documento', $aluno_documento_id, '', '', '');
    }
}
