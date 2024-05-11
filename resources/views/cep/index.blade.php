<!DOCTYPE html>
<html>

<head>
    <title>Consulta de CEP</title>
    <link href="{{ asset('css/cep/cep.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/cep/cep.js') }}"></script>
</head>

<body>
    <form action="/cep" method="post">
        @csrf
        <input type="text" id="cep" name="cep" placeholder="Digite o CEP" maxlength="9">
        <button type="button" id="consultar">Consultar</button>
        <div id="resultado"></div>

    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    @if (isset($endereco))
        <div class="resultado">
            <h2>Resultado:</h2>
            <p><strong>CEP:</strong> {{ $endereco->cep }}</p>
            <p><strong>Logradouro:</strong> {{ $endereco->logradouro }}</p>
            <p><strong>Bairro:</strong> {{ $endereco->bairro }}</p>
            <p><strong>Cidade:</strong> {{ $endereco->cidade }}</p>
            <p><strong>Estado:</strong> {{ $endereco->estado }}</p>
        </div>
    @endif

    <div id="overlay" style="display: none;">
        <div id="spinner"></div>
        <div id="loadingText"></div>
    </div>

</body>

</html>
