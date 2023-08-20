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
            <h2>Un problème est survenu lors de la suppression de la migration existante !</h2>
            @break
        @case(2)
            <h2>Un problème est survenu lors de la création du fichier de migration !</h2>
            @break
        @case(3)
            <h2>Un problème est survenu lors de la modification du fichier de migration !</h2>
            @break
        @case(4)
            <h2>Un problème est survenu lors de la modification du fichier de migration !</h2>
            @break
        @case(5)
            <h2>Un problème est survenu lors de la  !</h2>
            @break
        @case(6)
            <h2>Un problème est survenu lors de la creation de la base de données !</h2>
            @break
        @case(7)
            <h2>Un problème est survenu lors de l'écriture des données extraites en base de données !</h2>
            @break
        @case(8)
            <h2>Un problème est survenu lors de l'extraction des données du fichier !</h2>
            @break
        @case(9)
            <h2>Un problème est survenu lors de l'exportation des données !</h2>
            @break
        @case(10)
            <h2>L'export au format sql n'est pas compatible avec la base de donnée utilisée !</h2>
            @break
        @default
            
    @endswitch
    <p><b><a href="/">Retour a l'accueil</a></b></p>
</body>
</html>