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
                    <h3>Obrigado por ter cadastrado sua Escola em nosso Projeto.</h3>
                </td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">
                    <h3>Escola: {{$nome}}</h3>
                    <h4>Diretor: {{$diretor}}</h4>
                </td>
            </tr>
            </tbody>
        </table>
    </body>
</html>
