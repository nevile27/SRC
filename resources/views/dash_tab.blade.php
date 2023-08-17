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
    @include('nav')
    <section>
        <div id="visual">
            <div id="v1">
                <table>
                    <tr class="head">
                        <th> </th>
                        @foreach ($colonnes as $key => $item)
                            @if ($colonne != $item)
                                <th><a href="{{route('third')}}?colonne={{$item}}&ordre=asc&debut={{$debut}}">{{ $item }} <br> <span>({{ $types[$key] }})</span></a></th>
                            @else
                                @if ($ordre == "asc")
                                    <th><a href="{{route('third')}}?colonne={{$item}}&ordre=desc&debut={{$debut}}">{{ $item }} <br> <span>({{ $types[$key] }}) &#x2191;</span></a></th>  
                                @else
                                    <th><a href="{{route('third')}}?colonne={{$item}}&ordre=asc&debut={{$debut}}">{{ $item }} <br> <span>({{ $types[$key] }}) &#x2193;</span></a></th>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                    @foreach ($data as $key => $ligne)
                        <tr class="tr{{($key%2 != 0)? 1:2}}">
                            <td>{{++$key + $debut}}</td>
                            @foreach ($colonnes as $item)
                                <td>{{ $ligne->$item }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
            <div id="pgnt">
                <p id="pagination">
                    <a href="{{route('third')}}?colonne={{$colonne}}&ordre={{$ordre}}&debut=<?=(0 <= $debut-$limit)? ($debut-$limit):$debut?>">&laquo;</a>
                    <?php
                        $i = ceil($compte/$limit);
                        for ($j=0; $j < $i; $j++) { 
                            if($debut==$j*$limit){
                                echo '<a href="'.route('third').'?colonne='.$colonne.'&ordre='.$ordre.'&debut='.$j*$limit.'" class="active">'.($j+1).'</a>';
                            }else{
                                echo '<a href="'.route('third').'?colonne='.$colonne.'&ordre='.$ordre.'&debut='.$j*$limit.'">'.($j+1).'</a>';
                            }
                        } 
                    ?>
                    <a href="{{route('third')}}?colonne={{$colonne}}&ordre={{$ordre}}&debut=<?=($compte > $debut+$limit)? ($debut+$limit):$debut?>">&raquo;</a>
                </p>
            </div>
            <div id="v2">
                <table>
                    <tr class="head">
                        <th></th>
                        @foreach ($colonnes as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <td></td>
                        <?php $i = 0;?>
                        @foreach ($colonnes as $key => $item)
                            <td style="text-align: start;padding: 5px;">
                                @if (in_array($types[$key],['int','bigint','float','double','real','decimal']))
                                    Total: {{ $sums[$i] }}<br>
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
                <tr class="head">
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
</body>
</html>