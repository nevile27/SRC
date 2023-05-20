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
    <header>
        <p>En-tete</p>
    </header>
    <section>
        <ul>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card">
                    <a href="http://"><img src="{{ asset('images/camamber.png') }}" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                </div>
            </li>
        </ul>
    </section>
    <section>
        <div id="visual">
            <div id="v1">
                <table>
                    @foreach ($data as $key => $ligne)
                        @if ($key == 0)
                            <tr id="head">
                                <th> </th>
                                @foreach ($ligne as $item)
                                    <th>{{ $item }}</th>
                                @endforeach
                            </tr>
                        @else
                            <tr class="tr{{($key%2 == 0)? 1:2}}">
                                <td>{{$key}}</td>
                                @foreach ($ligne as $item)
                                    <td>{{ $item }}</td>
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div id="v2">
                <table>
                    <tr>
                        <th></th>
                        @foreach ($data[0] as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <td></td>
                        @foreach ($data[0] as $key => $item)
                            <td>
                                @if (in_array(Session::get('types')[$key],['int','bigint','float','double','real','decimal']))
                                    Min: <br>
                                    Max: <br>
                                    Moy: <br>
                                    EcT: <br>
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
                @foreach ($data[0] as $key => $item)
                    <tr>
                        <td>{{$item}}</td>
                        <td>{{Session::get('types')[$key]}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
    <footer>
        <p>Pied de page</p>
    </footer>
</body>
</html>