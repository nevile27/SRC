<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'erreur</title>
</head>
<body>
    <h1>Une erreur s'est produite</h1>
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
            @break
        @case(5)
            <h2>Impossible d'identifier les types des données annalysées, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
            @break
        @case(6)
            <h2>Impossible de créer la base de données, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
            @break
        @case(7)
            <h2>Impossible d'écrire les données extraites en base de données, veuillez vérifier le contenu de votre fichier csv et sélectionner les paramètres d'annalyse adéquat !</h2>
            @break
        @case(8)
            <h2>Un problème est survenu lors de l'extraction des données du fichier !</h2>
            @break
        @case(9)
            <h2>Impossible d'exporter les données au format sql, l'export au format sql n'est peut-etre compatible avec la base de donnée utilisée !</h2>
            @break
        @case(10)
            <h2></h2>
            @break
        @default
            
    @endswitch
    <p><b><a href="/">Retour a l'accueil</a></b></p>
</body>
</html>