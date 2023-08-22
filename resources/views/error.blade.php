<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/error.css')}}">
    <title>Page d'erreur</title>
</head>
<body>
    <div>
        <h1 id="error">Une erreur s'est produite</h1>
        @switch($error)
            @case(1)
                <h2>Le fichier de migration nécessaire à l'ecriture des données extraites en base de donnée n'a pas pu etre créé !</h2>
                @break
            @case(2)
                <h2>Le fichier de migration nécessaire à l'ecriture des données extraites en base de donnée n'a pas pu etre créé !!</h2>
                @break
            @case(3)
                <h2>Le fichier de migration nécessaire à l'ecriture des données extraites en base de donnée n'a pas pu etre créé !!!</h2>
                @break
            @case(4)
                <h2>Le nom d'une ou plusieurs colonnes identifiées ne respecte pas les regles de nommage, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
                <h4>Regles de nommage des colonnes en sql :</h4>
                <ul>
                    <li>ne pas dépasser 128 caractères (limite fixé a 64 caractères dans l'application);</li>
                    <li>commencer par une lettre;</li>
                    <li>comprendre uniquement les caractères suivants [ 'A' .. 'Z'] U ['a' .. 'z'] U [ '0' .. '9'] U [ '_' ];</li>
                    <li>un nom d'objet ne peut pas être un mot réservé de SQL sauf à être utilisé avec des guillemets;</li>
                    <li>être insensible à la casse</li>
                </ul>
                <h4>2 colonnes ne peuvent avoir un nom identique</h4>
                @break
            @case(5)
                <h2>Impossible d'identifier les types des données annalysées, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
                <h4>Paramètres d'analyses :</h4>
                <ul>
                    <li>Séparateur: caractère utilisé dans le fichier csv pour separer les colonnes ;</li>
                    <li>Encadrement du texte: caractère utilisé pour encadrer les chaines de caractères ;</li>
                    <li>Fin de ligne: caractère utilisée pour marquer la fin d'une ligne ;</li>
                    <li>Typage des données: nombres de lignes à utiliser pour la detection du type de données dans chaque colonnes ;</li>
                </ul>
                <h4>Plus le nombres de lignes est élevé plus le typage est efficace</h4>
                @break
            @case(6)
                <h2>Impossible de créer la base de données, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
                <h4>Paramètres d'analyses :</h4>
                <ul>
                    <li>Séparateur: caractère utilisé dans le fichier csv pour separer les colonnes ;</li>
                    <li>Encadrement du texte: caractère utilisé pour encadrer les chaines de caractères ;</li>
                    <li>Fin de ligne: caractère utilisée pour marquer la fin d'une ligne ;</li>
                    <li>Typage des données: nombres de lignes à utiliser pour la detection du type de données dans chaque colonnes ;</li>
                </ul>
                <h4>Plus le nombres de lignes est élevé plus le typage est efficace</h4>
                @break
            @case(7)
                <h2>Impossible d'écrire les données extraites en base de données, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
                <h4>Paramètres d'analyses :</h4>
                <ul>
                    <li>Séparateur: caractère utilisé dans le fichier csv pour separer les colonnes ;</li>
                    <li>Encadrement du texte: caractère utilisé pour encadrer les chaines de caractères ;</li>
                    <li>Fin de ligne: caractère utilisée pour marquer la fin d'une ligne ;</li>
                    <li>Typage des données: nombres de lignes à utiliser pour la detection du type de données dans chaque colonnes ;</li>
                </ul>
                <h4>Plus le nombres de lignes est élevé plus le typage est efficace</h4>
                @break
            @case(8)
                <h2>Un problème est survenu lors de l'extraction des données du fichier , veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
                <h4>Regles de nommage des colonnes en sql :</h4>
                <ul>
                    <li>ne pas dépasser 128 caractères (limite fixé a 64 caractères dans l'application);</li>
                    <li>commencer par une lettre;</li>
                    <li>comprendre uniquement les caractères suivants [ 'A' .. 'Z'] U ['a' .. 'z'] U [ '0' .. '9'] U [ '_' ];</li>
                    <li>un nom d'objet ne peut pas être un mot réservé de SQL sauf à être utilisé avec des guillemets;</li>
                    <li>être insensible à la casse</li>
                </ul>
                <h4>Un fichier vide ou contenant une seule ligne n'est pas exploitable</h4>
                @break
            @case(9)
                <h2>Le fichier de sql nécessaire à l'export des données au format sql n'a pas pu etre créé !</h2>
                @break
            @case(10)
                <h2>L'export au format sql n'est pas compatible avec la base de donnée utilisée !</h2>
                <h4>Bases de données prises en charges :</h4>
                <ul>
                    <li>MariaDB ;</li>
                    <li>MySQL ;</li>
                    <li>Sqlite ;</li>
                    <li>PostgreSQL ;</li>
                    <li>SQL Server ;</li>
                </ul>
                @break
            @case(11)
                <h2>Le nombre maximum de sessions actives sur le serveur a été attient, veuillez patienter quelques minutes et réessayer</h2>
                @break
            @default
                
        @endswitch
        <p><b><a href="{{url()->previous()}}">précédent</a></b> | <b><a href="/">Retour a l'accueil</a></b></p>
    </div>
</body>
</html>