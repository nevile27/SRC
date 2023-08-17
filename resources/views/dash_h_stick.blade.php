<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/dash_global.css')}}">
    <script src="{{asset('js/plotly-2.20.0.min.js')}}"></script>
    <title>Diagramme en batonnet horizontal</title>
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
            <form action="{{ route('five') }}" method="post" id="form_param">
                @csrf
                <input type="hidden" name="h">
                <div>
                    <h5>Abscisses</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="checkbox" id="x{{ $cle }}" name="x{{ $cle }}" value="{{ $cle }}" {{(isset($y) && in_array($cle,$x))? 'checked':''}}>
                        <label for="x{{ $cle }}">{{ $item }}</label><br>
                    @endforeach
                </div>
                <div>
                    <h5>Ordonnée</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="radio" id="y" name="y" value="{{ $cle }}" {{(isset($y) && $cle == $y)? 'checked':''}}>
                        <label for="y">{{ $item }}</label><br>
                    @endforeach
                </div>
                <button type="submit">Valider</button>
            </form>
        </div>
    </section>
    <script src="{{asset('js/h_stick.js')}}"></script>
</body>
</html>