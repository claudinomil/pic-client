<?php

namespace App\Http\Controllers;

use App\Facades\ApiData;
use App\Facades\Permissoes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
     * Função para ir na API e retornar informações
     */

    public function responseApi($op, $type, $uri, $id, $search_field, $search_value, $request)
    {
        //Buscando dados Api_Data()
        $response = ApiData::getData($type, $uri, $id, $search_field, $search_value, $request);
        dd($response->json());   //TRAZER ERRO NA DEPURAÇÃO

        //if ($uri == 'users/user/logged/data') {dd($response->json());}

        //Verificar error
        if (!isset($response['code']) or $response['code'] == 5000) {
            abort(500, 'Erro Interno => '.Route::currentRouteName().'##'.$response['message']);
        }

        //Dados de Retorno
        if ($op == 1) {
            $this->message = $response['message'];
            $this->code = $response['code'];
            $this->validation = $response['validation'];
            $this->content = $response['content'];
        }

        //Dados de Retorno (Auxiliares/Combobox)
        if ($op == 2) {
            if (isset($response['content']['generos'])) {$this->generos = $response['content']['generos'];}
            if (isset($response['content']['estados_civis'])) {$this->estados_civis = $response['content']['estados_civis'];}
            if (isset($response['content']['escolaridades'])) {$this->escolaridades = $response['content']['escolaridades'];}
            if (isset($response['content']['nacionalidades'])) {$this->nacionalidades = $response['content']['nacionalidades'];}
            if (isset($response['content']['naturalidades'])) {$this->naturalidades = $response['content']['naturalidades'];}
            if (isset($response['content']['identidade_orgaos'])) {$this->identidade_orgaos = $response['content']['identidade_orgaos'];}
            if (isset($response['content']['identidade_estados'])) {$this->identidade_estados = $response['content']['identidade_estados'];}
            if (isset($response['content']['funcoes'])) {$this->funcoes = $response['content']['funcoes'];}
            if (isset($response['content']['departamentos'])) {$this->departamentos = $response['content']['departamentos'];}
            if (isset($response['content']['funcionarios'])) {$this->funcionarios = $response['content']['funcionarios'];}
            if (isset($response['content']['grupos'])) {$this->grupos = $response['content']['grupos'];}
            if (isset($response['content']['groupo_permissoes'])) {$this->groupo_permissoes = $response['content']['groupo_permissoes'];}
            if (isset($response['content']['modulos'])) {$this->modulos = $response['content']['modulos'];}
            if (isset($response['content']['submodulos'])) {$this->submodulos = $response['content']['submodulos'];}
            if (isset($response['content']['notificacoes'])) {$this->notificacoes = $response['content']['notificacoes'];}
            if (isset($response['content']['notificacoes_lidas'])) {$this->notificacoes_lidas = $response['content']['notificacoes_lidas'];}
            if (isset($response['content']['operacoes'])) {$this->operacoes = $response['content']['operacoes'];}
            if (isset($response['content']['permissoes'])) {$this->permissoes = $response['content']['permissoes'];}
            if (isset($response['content']['situacoes'])) {$this->situacoes = $response['content']['situacoes'];}
            if (isset($response['content']['ferramentas'])) {$this->ferramentas = $response['content']['ferramentas'];}
            if (isset($response['content']['estados'])) {$this->estados = $response['content']['estados'];}
            if (isset($response['content']['transacoes'])) {$this->transacoes = $response['content']['transacoes'];}
            if (isset($response['content']['users'])) {$this->users = $response['content']['users'];}
            if (isset($response['content']['tipos_escolas'])) {$this->tipos_escolas = $response['content']['tipos_escolas'];}
            if (isset($response['content']['niveis_ensinos'])) {$this->niveis_ensinos = $response['content']['niveis_ensinos'];}
            if (isset($response['content']['racas'])) {$this->racas = $response['content']['racas'];}
            if (isset($response['content']['escolas'])) {$this->escolas = $response['content']['escolas'];}
            if (isset($response['content']['alunos'])) {$this->alunos = $response['content']['alunos'];}
            if (isset($response['content']['professores'])) {$this->professores = $response['content']['professores'];}
            if (isset($response['content']['turmas'])) {$this->turmas = $response['content']['turmas'];}
            if (isset($response['content']['alunos_turmas_professores'])) {$this->alunos_turmas_professores = $response['content']['alunos_turmas_professores'];}
            if (isset($response['content']['sistema_acessos'])) {$this->sistema_acessos = $response['content']['sistema_acessos'];}
            if (isset($response['content']['nees'])) {$this->nees = $response['content']['nees'];}
        }
    }

    /*
     * Função para retornar Botões para a coluna Ações da tabela de registros do CRUD
     */
    public function columnAction($id, $ajaxPrefixPermissaoSubmodulo, $userLoggedPermissoes)
    {
        $btnType = 4;

        //Montando Coluna Ação
        $btn = '<td class="text-center" style="vertical-align:top; white-space:nowrap;"><div class="row">';

        if (Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_show'], $userLoggedPermissoes)) {
            if ($btnType == 1) {$btnClass = 'btn btn-info text-white text-center btn-sm'; $btnSize = '';}
            if ($btnType == 2) {$btnClass = 'btn text-info text-center btn-sm'; $btnSize = 'font-size-18';}
            if ($btnType == 3) {$btnClass = 'btn btn-outline-secondary btn-sm'; $btnSize = '';}
            if ($btnType == 4) {$btnClass = 'btn btn-outline-info text-center btn-sm'; $btnSize = 'font-size-18';}

            $btn .= '<div class="col-4"><button type="button" class="viewRecord '.$btnClass.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar Registro" data-id="'.$id.'"><i class="fa fa-eye '.$btnSize.'"></i></button></div>';
        }

        if (Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes)) {
            if ($btnType == 1) {$btnClass = 'btn btn-primary text-white text-center btn-sm'; $btnSize = '';}
            if ($btnType == 2) {$btnClass = 'btn text-primary text-center btn-sm'; $btnSize = 'font-size-18';}
            if ($btnType == 3) {$btnClass = 'btn btn-outline-secondary btn-sm'; $btnSize = '';}
            if ($btnType == 4) {$btnClass = 'btn btn-outline-primary text-center btn-sm'; $btnSize = 'font-size-18';}

            $btn .= '<div class="col-4"><button type="button" class="editRecord '.$btnClass.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Alterar Registro" data-id="'.$id.'"><i class="fas fa-pencil-alt '.$btnSize.'"></i></button></div>';
        }

        if (Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_destroy'], $userLoggedPermissoes)) {
            if ($btnType == 1) {$btnClass = 'btn btn-danger text-white text-center btn-sm'; $btnSize = '';}
            if ($btnType == 2) {$btnClass = 'btn text-danger text-center btn-sm'; $btnSize = 'font-size-18';}
            if ($btnType == 3) {$btnClass = 'btn btn-outline-secondary btn-sm'; $btnSize = '';}
            if ($btnType == 4) {$btnClass = 'btn btn-outline-danger text-center btn-sm'; $btnSize = 'font-size-18';}

            $btn .= '<div class="col-4"><button type="button" class="deleteRecord '.$btnClass.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Registro" data-id="'.$id.'"><i class="fa fa-trash-alt  '.$btnSize.'"></i></button></div>';
        }

        $btn .= '</div></td>';

        return $btn;
    }
}
