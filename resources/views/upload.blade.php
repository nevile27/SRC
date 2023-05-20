<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @isset($path)
        <div>
            <h2>Fichier enregistré</h2>
            <button><a href="{{ route('first') }}">ANALYSER LES DONNEES</a></button>
        </div>
    @else
        @if ($errors->any)
            @foreach ($errors->all() as $error)
                <div style="color: red; font-size: 24;">{{ $error }}</div>
            @endforeach
        @endif
        <form action="/" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="file">Inserer le fichier CSV :</label>
                <input type="file" name="file" id="file">
            </div>
            <div>
                <img src="{{ asset('images/camamber.png') }}" alt="img">
            </div>
            <input type="submit" value="Envoyer">
        </form>
    @endisset
</body>
</html>