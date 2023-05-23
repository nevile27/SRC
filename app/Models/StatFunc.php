<?php

namespace App\Models;

class StatFunc
{

    public function ecarType($colonne)
    {
        //0 - Nombre d’éléments dans le tableau
        $population = count($colonne);
        if ($population != 0) {
            //1 - somme du tableau
            $somme_tableau = array_sum($colonne);
            //2 - Calcul de la moyenne
            $moyenne = $somme_tableau / $population;
            //3 - écart pour chaque valeur
            $ecart = [];
            for ($i = 0; $i < $population; $i++) {
                //écart entre la valeur et la moyenne
                $ecart_donnee = $colonne[$i] - $moyenne;
                //carré de l'écart
                $ecart_donnee_carre = bcpow($ecart_donnee, 2, 2);
                //Insertion dans le tableau
                array_push($ecart, $ecart_donnee_carre);
            }
            //4 - somme des écarts
            $somme_ecart = array_sum($ecart);
            //5 - division de la somme des écarts par la population
            $division = $somme_ecart / $population;
            //6 - racine carrée de la division
            //dd(number_format($division, 2,'.',''));
            $ecart_type = bcsqrt(number_format($division, 2,'.',''), 2);
        } else {
            $ecart_type = "Le tableau est vide";
        }
        //7 - renvoi du résultat
        return $ecart_type;
    }
}
