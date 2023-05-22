<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class EnviarEmailController extends Controller
{
    public function publico_escolas($nome, $telefone, $diretor, $endereco, $email, $motivo)
    {
        //Enviando e-mail
        Mail::send('emails.publico_escolas', ['nome' => $nome, 'diretor' => $diretor], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Cadastro Escolas');
        });

        //Enviando e-mail
        Mail::send('emails.publico_escolas_retorno', ['nome' => $nome, 'telefone' => $telefone, 'diretor' => $diretor, 'endereco' => $endereco, 'email' => $email, 'motivo' => $motivo], function ($message) {
            $message->to('davinni@inclusaocolaborativa.com.br');
            $message->subject('Cadastro Escolas');
        });
    }

    public function publico_escolas_view()
    {
        return view('emails.publico_escolas');
    }

    public function avaliacoes_avaliacao($resposta_pergunta_1, $resposta_pergunta_2, $resposta_pergunta_3, $usuario)
    {
        //Enviando e-mail
        Mail::send('emails.avaliacoes_avaliacao', ['resposta_pergunta_1' => $resposta_pergunta_1, 'resposta_pergunta_2' => $resposta_pergunta_2, 'resposta_pergunta_3' => $resposta_pergunta_3, 'usuario' => $usuario], function ($message) use($usuario) {
            $message->to('davinni@inclusaocolaborativa.com.br');
            $message->subject('Avalie-nos - Avaliação do Usuário '.$usuario);
        });
    }
}
