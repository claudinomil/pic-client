<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CriarSubmodulos;

//Rota inicial
Route::get('/', function () {
    return view('welcome');
});

//Rotas de auth
require __DIR__.'/routes_auth.php';

//Rotas Language Translation
require __DIR__.'/routes_translation.php';

//Modulos
require __DIR__.'/routes_modulos.php';

//Submodulos
require __DIR__.'/routes_submodulos.php';

//Tools
require __DIR__.'/routes_ferramentas.php';

//Notificacoes
require __DIR__.'/routes_notificacoes.php';

//Transacoes
require __DIR__.'/routes_transacoes.php';

//Groups
require __DIR__.'/routes_grupos.php';

//Users
require __DIR__.'/routes_users.php';

//Departamentos
require __DIR__.'/routes_departamentos.php';

//Funcionarios
require __DIR__.'/routes_funcionarios.php';

//Generos
require __DIR__.'/routes_generos.php';

//EstadosCivis
require __DIR__.'/routes_estados_civis.php';

//Nacionalidades
require __DIR__.'/routes_nacionalidades.php';

//Naturalidades
require __DIR__.'/routes_naturalidades.php';

//Funcoes
require __DIR__.'/routes_funcoes.php';

//Escolaridades
require __DIR__.'/routes_escolaridades.php';

//Identityorgans
require __DIR__.'/routes_identidade_orgaos.php';

//Dashboards
require __DIR__.'/routes_dashboards.php';

//Tipos Escolas
require __DIR__.'/routes_tipos_escolas.php';

//Niveis Ensinos
require __DIR__.'/routes_niveis_ensinos.php';

//Escolas
require __DIR__.'/routes_escolas.php';

//Professores
require __DIR__.'/routes_professores.php';

//Alunos
require __DIR__.'/routes_alunos.php';

//Turmas
require __DIR__.'/routes_turmas.php';

//Deficiencias
require __DIR__.'/routes_deficiencias.php';

//Rotas para Criar Submódulos Padronizados (Controller / Views / Js)
Route::get('/criarsubmodulos/{password}', [CriarSubmodulos::class, 'index'])->name('criarsubmodulos.index');
Route::post('/criarsubmodulos', [CriarSubmodulos::class, 'store'])->name('criarsubmodulos.store');
