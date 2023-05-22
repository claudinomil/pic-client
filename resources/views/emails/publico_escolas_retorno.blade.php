<!DOCTYPE html>
<html>
    <head>
        <title>{{env('APP_NAME')}}</title>
    </head>
    <body>
        <table width="100%">
            <tbody>
            <tr>
                <td align="">
                    <img src="{{ asset('build/assets/images/image_logo_email.png') }}" alt="" height="100">
                </td>
            </tr>
            <tr>
                <td align="" style="color: deepskyblue; font-family: arial;">
                    <h3>Cadastro de Escola</h3>
                </td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">
                    <h3>Escola: {{$nome}}</h3>
                    <h4>Telefone: {{$telefone}}</h4>
                    <h4>Diretor: {{$diretor}}</h4>
                    <h4>Endereço: {{$endereco}}</h4>
                    <h4>E-mail: {{$email}}</h4>
                    <h4>Motivo: {{$motivo}}</h4>
                </td>
            </tr>
            </tbody>
        </table>
    </body>
</html>
