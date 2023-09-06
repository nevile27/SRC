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
            <a href="{{ route('four') }}">Batônnets V</a>
        </li>
        <li {{ ($route == 'five')? 'class=selected':'' }}>
            <a href="{{ route('five') }}">Batônnets H</a>
        </li>
        <li {{ ($route == 'six')? 'class=selected':'' }}>
            <a href="{{ route('six') }}">Histogrammes V</a>
        </li>
        <li {{ ($route == 'seven')? 'class=selected':'' }}>
            <a href="{{ route('seven') }}">Histogrammes H</a>
        </li>
        <li {{ ($route == 'eight')? 'class=selected':'' }}>
            <a href="{{ route('eight') }}">Camemberts</a>
        </li>
    </ul>
    <button> <a href="/">Accueil</a></button>
</nav>
<div id="download">
    @switch($route)
        @case('four')
            <h2>Sélectionnez l’abscisse et les ordonnées pour tracer vos diagrammes à partir des données :</h2>
            @break
        @case('five')
            <h2>Sélectionnez les abscisses et l’ordonnée pour tracer vos diagrammes à partir des données :</h2>
            @break
        @case('six')
            <h2>Sélectionnez les colonnes pour tracer vos histogrammes à partir des données :</h2>
            @break
        @case('seven')
            <h2>Sélectionnez les colonnes pour tracer vos histogrammes à partir des données :</h2>
            @break
        @case('eight')
            <h2>Sélectionnez la référence et les quantités pour tracer vos camemberts à partir des données :</h2>
            @break
        @case('nine')
            <h2>Sélectionnez l’abscisse et les ordonnées pour tracer vos nuages de points à partir des données :</h2>
            @break
        @case('ten')
            <h2>Sélectionnez l’abscisse et les ordonnées pour tracer vos courbes à partir des données :</h2>
            @break
        @default
            <h2>Télécharger les données :</h2>
            <button><a href="{{route('eleven')}}">format SQL</a></button>
            <button><a href="{{route('twelve')}}?colonne={{$colonne}}&ordre={{$ordre}}">format PDF</a></button>  
    @endswitch
</div>
<input type="hidden" name="hote" value="{{config('app.url')}}">