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
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <table width="100%">
            <tbody>
                <tr>
                    <td align="" style="color: deepskyblue; font-family: arial;">
                        <h5>Avaliação feita em {{date('d/m/Y')}} as {{date('H:i')}} por {{$usuario}}.</h5>
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%">
            <tbody>
            <tr>
                <td align="" style="color: black; font-family: arial;">1) As informações disponibilizadas no site contribuíram para a sua prática profissional com crianças com necessidades educacionais especiais?</td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">{{$resposta_pergunta_1}}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">2) A plataforma contribuiu no processo de colaboração entre você e a professora da Sala de Recursos?</td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">{{$resposta_pergunta_2}}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">3) Quais os aspéctos a serem melhorados quanto ao conteúdo e à estrutura do site?</td>
            </tr>
            <tr>
                <td align="" style="color: black; font-family: arial;">{{$resposta_pergunta_3}}</td>
            </tr>
            </tbody>
        </table>
    </body>
</html>
