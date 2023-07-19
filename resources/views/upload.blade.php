<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/upload.css')}}">
    <title>Document</title>
</head>
<body>
    @isset($path)
        <form action="{{ route('first') }}">
            <h2>Fichier enregistré</h2>
            <button>ANALYSER LES DONNEES</button>
        </form>
    @else
        <form action="/" method="post" enctype="multipart/form-data">
            @csrf
            @if ($errors->any)
                @foreach ($errors->all() as $error)
                    <div id="error">{{ $error }}</div>
                @endforeach
            @endif
            @if (\Session::has('success') && \Session::get('success') == false)
                <div id="error">{{ \Session::get('message') }}</div>
            @endif
            <div>
                <label for="file">
                    <i class="fa-solid fa-file-arrow-up fa-shake"></i> 
                    <span id="name">Sélectionner le fichier CSV</span>
                </label>
                <input type="file" name="fichier" id="file" style="display: none"/>
            </div>
            <div>
                <button type="submit" id="submit" class="none">Envoyer</button>
            </div>
        </form>
    @endisset
    <script>
        document.querySelector('#file').onchange = function (e) {
            e.preventDefault();
            var files = this.files,
                name = files[0].name;
            console.log(files);
            var span = document.querySelector('#name');
            span.innerHTML = name;
            span.style.fontStyle = "italic";
        }
    </script>
</body>
</html>