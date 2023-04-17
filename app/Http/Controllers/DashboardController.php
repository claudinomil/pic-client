<?php

namespace App\Http\Controllers;

use App\Facades\Permissoes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    //Variáveis de dashboards
    public $dashboardsUsers = 'dashboardsUsers';
    public $dashboardsProfessores = 'dashboardsProfessores';

    public function __construct()
    {
        $this->middleware('check-permissao:dashboards_list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        //Requisição Ajax
        if ($request->ajax()) {
            $id = $_GET['id'];
            $data = $_GET['data'];

            //Buscando dados Api_Data() - Lista de Registros
            $this->responseApi(1, 8, 'dashboards', $id.'/'.$data, '', '', '');

            return json_encode($this->content);
        } else {
            //Permissoes
            if (!Permissoes::permissao(['users_list'], $request['userLoggedPermissoes'])) {$this->dashboardsUsers = '';}
            if (!Permissoes::permissao(['professores_list'], $request['userLoggedPermissoes'])) {$this->dashboardsProfessores = '';}

            //Dados recebidos com sucesso
            return view('dashboards.index', ['dashboardsUsers' => $this->dashboardsUsers, 'dashboardsProfessores' => $this->dashboardsProfessores]);
        }
    }
}
