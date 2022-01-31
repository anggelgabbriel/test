<!doctype html>
<html>
<head>
    <title>DeltaLab - Resultado de exames</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div>
        <div>
            <div class="img-container">
                <img src="images/logo.svg" class="mt-2">
            </div>
            <p>deltacovid.herokuapp.com/</p>

            <table class="mt-4">
                <tr>
                    <td>Nome</td>
                    <td>: {{$exam->user->name}}</td>
                </tr>
                <tr>
                    <td>CPF</td>
                    <td>: {{$exam->user->cpf}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{$exam->user->email}}</td>
                </tr>
                <tr>
                    <td>Data de Nascimento</td>
                    <td>: {{$exam->user->birth_date->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td>Idade</td>
                    <td>: {{\Carbon\Carbon::instance($exam->user->birth_date)->age}} anos</td>
                </tr>
                <tr>
                    <td>Data do Pedido</td>
                    <td>: {{$exam->created_at->format('d/m/Y H:i:s')}}</td>
                </tr>
                <tr>
                    <td>Data do Agendamento</td>
                    <td>: {{$exam->date->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td>Data de Emissão</td>
                    <td>: {{$exam->updated_at->format('d/m/Y H:i:s')}}</td>
                </tr>
            </table>
            <hr/>
            <h6 style="text-decoration: underline">EXAME DE SANGUE PARA DETECÇÃO DO COVID-19 / DELTA</h6>
            <p><b>Método:</b> RT-PCR / SARS-CoV-2</p>
            <div>
                <span><b>RESULTADO:</b></span> <span class="ml-4">
                    @if($exam->type == 0)
                        NÃO REAGENTE
                    @elseif($exam->type == 1)
                        COVID-19 (Não Delta)
                    @else
                        DELTA
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
</body>

<style>
    body {
        font-family: 'Courier'
    }

    tr td:first-child {
        font-weight: bold;
    }

    img {
        height: 60px;
        padding: 8px;
    }

    .img-container {
        background-color: #0C082B;
    }

    hr {
        border: 1px solid;
    }
</style>
</html>
