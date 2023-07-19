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
        <li {{ ($route == 'eight')? 'class=selected':'' }}>
            <a href="{{ route('eight') }}">Camambers</a>
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
    </ul>
    <button> <a href="/">Accueil</a></button>
</nav>