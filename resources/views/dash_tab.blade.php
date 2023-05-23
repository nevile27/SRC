<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/dash_global.css')}}">
    <link rel="stylesheet" href="{{asset('css/dash_tab.css')}}">
    <title>Document</title>
</head>
<body>
    @include('header')
    @include('nav')
    <section>
        <div id="visual">
            <div id="v1">
                <table>
                    <tr id="head">
                        <th> </th>
                        @foreach ($colonnes as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                    @foreach ($data as $key => $ligne)
                        <tr class="tr{{($key%2 == 0)? 1:2}}">
                            <td>{{$key}}</td>
                            @foreach ($colonnes as $item)
                                <td>{{ $ligne[$item] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
            <div id="v2">
                <table>
                    <tr>
                        <th></th>
                        @foreach ($colonnes as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <td></td>
                        <?php $i = 0;?>
                        @foreach ($colonnes as $key => $item)
                            <td>
                                @if (in_array($types[$key],['int','bigint','float','double','real','decimal']))
                                    Min: {{ $mins[$i] }}<br>
                                    Max: {{ $maxs[$i] }}<br>
                                    Moy: {{ $moys[$i] }}<br>
                                    EcT: {{ $ects[$i] }}<br>
                                    <?php $i++;?>
                                @else
                                    Valeurs non numériques
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
        <div id="param">
            <table>
                <tr>
                    <th>Colonnes</th>
                    <th>Types detectés</th>
                </tr>
                @foreach ($colonnes as $key => $item)
                    <tr>
                        <td>{{$item}}</td>
                        <td>{{$types[$key]}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
    @include('footer')
</body>
</html>