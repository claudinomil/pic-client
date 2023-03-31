<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //Variaveis de Retorno da API
    public $message;
    public $code;
    public $validation;
    public $content;

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function loginApi(Request $request)
    {
        //Validando dados
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Digite seu E-mail.',
                'email.email' => 'E-mail inválido',
                'password.required' => 'Digite sua Senha.'
            ]
        );

        //Buscando dados Api_Data() - Verificar se email já foi confirmado
        $this->responseApi(1, 10, 'users/confirm/'.$request->email, '', '', '', '');

        if ($this->code == 2000) {
            //CHAMADA DO PASSPORT COM 'grant_type' => 'password'''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            /*
             * Criar Client na API: php artisan passport:client --password
             * Não precisa de Authorization, envia direto as credenciais
             * Vai na API e retorna o Access Token
             */

            $response = Http::post(env('PASSPORT_API_URL') . 'oauth/token', [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username' => $request['email'],
                'password' => $request['password'],
                'scope' => 'claudino',
            ]);
            //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

            //Se o retorno for um Error
            if (isset($response['error'])) {
                $error = $response['message'];
                return view('auth.login', compact('error'));
            }

            //Gravar access_token em ums session
            session(['access_token' => $response['access_token']]);

            //Redirecionar para o Submódulo inicial
            return redirect('dashboards');
        }

        if ($this->code == 2004) {
            $email = $request->email;

            //Ir para a view de confirmação
            return redirect('/confirm-email')->with('email', $email);
        }

        if ($this->code == 2005) {
            $error = 'E-mail não encontrado!';

            //Retorno para a view
            return view('auth.login', compact('error'));
        }
    }

    public function logout()
    {
        //Buscando dados Api_Data() - Fazer Logout
        $this->responseApi(1, 7, '', '', '', '', '');

        return view('welcome');
    }
}
