<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/dash_global.css')}}">
    <script src="{{asset('js/plotly-2.20.0.min.js')}}"></script>
    <title>Camenbert</title>
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
            <form action="{{ route('eight') }}" method="post" id="form_param">
                @csrf
                <input type="hidden" name="h">
                <div>
                    <h5>Référence</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="radio" id="x" name="x" value="{{ $cle }}" {{(isset($x) && $cle == $x)? 'checked':''}}>
                        <label for="x">{{ $item }}</label><br>
                    @endforeach
                </div>
                <div>
                    <h5>Données quantitatives</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="checkbox" id="y{{ $cle }}" name="y{{ $cle }}" value="{{ $cle }}" {{(isset($x) && in_array($cle,$y))? 'checked':''}}>
                        <label for="y{{ $cle }}">{{ $item }}</label><br>
                    @endforeach
                </div>
                <button type="submit">Valider</button>
            </form>
        </div>
    </section>
    <script src="{{asset('js/circle.js')}}"></script>
</body>
</html>