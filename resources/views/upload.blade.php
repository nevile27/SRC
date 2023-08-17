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
        <form action="{{ route('first') }}" id="f1">
            
            <h3>Définnissez les paramettres d'annalyse :</h3>
            <div>
                <div>
                    <label for="spec1">Séparateur : </label><br/>
            <select name="spec1" class="opt">
                <option value="1">Espace ( )</option>
                <option value="2"selected>Virgule (,)</option>
                <option value="3">Point virgule (;)</option>
            </select>
                </div>
            <div>
                <label for="spec2">Encadrement du texte : </label><br/>
            <select name="spec2" class="opt">
                <option value="5" selected>Aucun ( )</option>
                <option value="4">Griffes (')</option>
                <option value="5">Double griffes (")</option>
            </select>
            </div>
            <div>
                <label for="spec3">Fin de ligne : </label><br/>
            <select name="spec3" class="opt">
                <option value="7">Aucun ( )</option>
                <option value="2">Virgule (,)</option>
                <option value="3">Point virgule (;)</option>
                <option value="4">Griffes (')</option>
                <option value="5">Double griffes (")</option>
                <option value="6">Slash (/)</option>
                <option value="7">Anti-slash (\)</option>
            </select>
            </div>
            <div>
                <label for="spec4">Typage des données : </label><br/>
            <select name="spec4" class="opt">
                <option value="20">20 lignes</option>
                <option value="100">100 lignes</option>
                <option value="200">200 lignes</option>
                <option value="500">500 lignes</option>
                <option value="0">Toutes les lignes</option>
            </select>
            </div>
            </div>
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