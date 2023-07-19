<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/dash_global.css')}}">
    <link rel="stylesheet" href="">
    <script src="https://cdn.plot.ly/plotly-2.20.0.min.js" charset="utf-8"></script>
    <title>Document</title>
</head>
<body>
    @include('nav')
    <section>
        <div id="visual">
            <div id="v1">
                <div id="tester"></div>
            </div>
            <div id="v2">
                
            </div>
        </div>
        <div id="param">
            <form action="{{ route('six') }}" method="post" id="form_param">
                @csrf
                <input type="hidden" name="h">
                <div>
                    <h5>Abscisses</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="checkbox" id="y{{ $cle }}" name="y{{ $cle }}" value="{{ $cle }}" {{(isset($x) && $cle == $x)? 'checked':''}}>
                        <label for="y{{ $cle }}">{{ $item }}</label><br>
                    @endforeach
                </div>
                <div>
                    <h5>Mode</h5>
                    <input type="radio" class="mode" name="mode" value="stack" checked>
                    <label for="type">Entassé</label><br>
                    <input type="radio" class="mode" name="mode" value="overlay">
                    <label for="type">Supperposé</label><br>
                </div>
                <button type="submit">Valider</button>
            </form>
        </div>
    </section>
    <script src="{{asset('js/h_hist.js')}}"></script>
</body>
</html>