<nav>
    <ul>
        <li {{ ($route == 'third')? 'class=selected':'' }}>
            <a href="{{ route('third') }}">Table</a>
        </li>
        <li {{ ($route == 'ten')? 'class=selected':'' }}>
            <a href="{{ route('ten') }}">Courbes</a>
        </li>
        <li {{ ($route == 'nine')? 'class=selected':'' }}>
            <a href="{{ route('nine') }}">Nuages</a>
        </li>
        <li {{ ($route == 'four')? 'class=selected':'' }}>
            <a href="{{ route('four') }}">Batonnets V</a>
        </li>
        <li {{ ($route == 'five')? 'class=selected':'' }}>
            <a href="{{ route('five') }}">Batonnets H</a>
        </li>
        <li {{ ($route == 'six')? 'class=selected':'' }}>
            <a href="{{ route('six') }}">Histogrammes V</a>
        </li>
        <li {{ ($route == 'seven')? 'class=selected':'' }}>
            <a href="{{ route('seven') }}">Histogrammes H</a>
        </li>
        <li {{ ($route == 'eight')? 'class=selected':'' }}>
            <a href="{{ route('eight') }}">Camambers</a>
        </li>
    </ul>
    <button> <a href="/">Accueil</a></button>
</nav>
<div id="download">
    @switch($route)
        @case('four')
            <h2>Selectionnez Abscisse et Ordonnées pour tracer vos diagrammes a partir des données :</h2>
            @break
        @case('five')
            <h2>Selectionnez Abscisses et Ordonnée pour tracer vos diagrammes a partir des données :</h2>
            @break
        @case('six')
            <h2>Selectionnez les colonnes pour tracer vos histogrammes a partir des données :</h2>
            @break
        @case('seven')
            <h2>Selectionnez les colonnes pour tracer vos histogrammes a partir des données :</h2>
            @break
        @case('eight')
            <h2>Selectionnez Référence et Données pour tracer vos camambers a partir des données :</h2>
            @break
        @case('nine')
            <h2>Selectionnez Abscisse et Ordonnées pour tracer vos nuages de points a partir des données :</h2>
            @break
        @case('ten')
            <h2>Selectionnez Abscisse et Ordonnées pour tracer vos courbes a partir des données :</h2>
            @break
        @default
            <h2>Télécharger les données :</h2>
            <button><a href="{{route('eleven')}}">format SQL</a></button>
            <button><a href="{{route('twelve')}}?colonne={{$colonne}}&ordre={{$ordre}}">format PDF</a></button>  
    @endswitch
</div>
<input type="hidden" name="hote" value="{{config('app.url')}}">