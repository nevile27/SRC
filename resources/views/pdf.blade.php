<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page{
            size: a4 portrait;
        }
        table{
            max-width: 600px;
            padding: 0 0 5px 0;
            border: 1px solid gray;
            border-radius: 5px;
            box-shadow: 0px 0px 2px gray;
            margin: 10px;
            background-color: white;
        }
        table tr th{
            padding: 5px;
            color: white;
            background-color: rgba(127, 127, 127, 1);
            font-family: sans-serif;
        }
        table tr.head{
            border-radius: 5px 5px 0 0;
        }
        table tr.head th:first-child{
            border-radius: 5px 0 0 0;
        }
        table tr.head th:nth-last-child(1){
            border-radius: 0 5px 0 0;
        }
        table tr th span{
            font-weight: normal;
        }
        table tr td{
            font-weight: bold;
            padding: 5px 0px;
            text-align: center;
        }
        table tr td button{
            padding: 5px;
            margin: auto 5px;
            border-radius: 2px;
            box-shadow: 0px 0px 2px gray;
            border: none;
            outline: none;
            cursor: pointer;
        }
        table tr td a{
            text-decoration: none;
        }
        .tr1{
            background-color: rgba(127, 127, 127, 0.1);
        }
        .tr2{

        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <tr class="head">
            <th>Colonnes</th>
            <th>Types detectés</th>
            <th>Données statistiques</th>
        </tr>
        <?php $i = 0;?>
        @foreach ($colonnes as $key => $item)
            <tr class="tr{{($key%2 != 0)? 1:2}}">
                <td>{{$item}}</td>
                <td>{{$types[$key]}}</td>
                <td style="text-align: left; padding-left: 5px;">
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
            </tr>
        @endforeach
    </table>
    <table>
        <tr class="head">
            <th> </th>
            @foreach ($colonnes as $key => $item)
                <th>{{ $item }} <br> <span>({{ $types[$key] }})</span></th>
            @endforeach
        </tr>
        @foreach ($data as $key => $ligne)
            <tr class="tr{{($key%2 != 0)? 1:2}}">
                <td>{{++$key}}</td>
                @foreach ($colonnes as $item)
                    <td>{{ $ligne->$item }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>