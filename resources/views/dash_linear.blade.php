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
            <form action="{{ route('ten') }}" method="post" id="form_param">
                @csrf
                <input type="hidden" name="h">
                <div>
                    <h5>Abscisse</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="radio" id="x" name="x" value="{{ $cle }}" {{(isset($x) && $cle == $x)? 'checked':''}}>
                        <label for="x">{{ $item }}</label><br>
                    @endforeach
                </div>
                <div>
                    <h5>Ordonnées</h5>
                    @foreach ($colonnes as $cle => $item)
                        <input type="checkbox" id="y{{ $cle }}" name="y{{ $cle }}" value="{{ $cle }}" {{(isset($x) && in_array($cle,$y))? 'checked':''}}>
                        <label for="y{{ $cle }}">{{ $item }}</label><br>
                    @endforeach
                </div>
                <div>
                    <h5>Mode</h5>
                    <input type="radio" class="mode" name="mode" value="lines" checked>
                    <label for="type">Ligne</label><br>
                    <input type="radio" class="mode" name="mode" value="lines+markers">
                    <label for="type">Lignes+points</label><br>
                </div>
                <div>
                    <h5>Forme</h5>
                    <input type="radio" class="forme" name="forme" value="hv">
                    <label for="forme">hv</label><br>
                    <input type="radio" class="forme" name="forme" value="vh">
                    <label for="forme">vh</label><br>
                    <input type="radio" class="forme" name="forme" value="hvh">
                    <label for="forme">hvh</label><br>
                    <input type="radio" class="forme" name="forme" value="hvh">
                    <label for="forme">vhv</label><br>
                    <input type="radio" class="forme" name="forme" value="spline" checked>
                    <label for="forme">courbes</label><br>
                    <input type="radio" class="forme" name="forme" value="linear">
                    <label for="forme">droites</label><br>
                </div>
                <button type="submit">Valider</button>
            </form>
        </div>
    </section>
    <script src="{{asset('js/linear.js')}}"></script>
</body>
</html>