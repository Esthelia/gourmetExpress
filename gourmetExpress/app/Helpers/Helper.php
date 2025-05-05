<?php

namespace App\Helpers;

use App\Models\Product;
use Carbon\Carbon;

class Helper
{
    const JOURS = [
        'Lundi',
        'Mardi',
        'Mercredi',
        'Jeudi',
        'Vendredi',
        'Samedi',
        'Dimanche'
    ];

    public static function menu(): string
    {
        $menus = [
            "Menu du Lundi : Poulet Kedjenou, Attiéké et poisson grillé, Porc Braisé ",
            "Menu du Mardi : Poulet Braisé, Gbofloto, Kplé avec Côte de porc",
            "Menu du Mercredi : Poulet Yassa, Sauce Gombo à la viande de boeuf grillé, Porc en sauce",
            "Menu du Jeudi : Poulet Dôkloun, Kédjénou de boeuf, Poulet curry, Poisson Braisé, Macheron Fumé à la braise, Brochette de Viande de Boeuf",
            "Menu du Vendredi : Sauce claire au poulet, Ragoût de boeuf, Poulet à la moutarde",
            "Menu du Samedi : Poulet Kabato , Sauce arachide au boeuf, Porc Kpakpato",
            "Menu du Dimanche : Brunch, Gâteau, Dessert"
        ];

        $jourIndex = date('N') - 1; // date('N') retourne 1 pour Lundi et 7 pour Dimanche
        return $menus[$jourIndex] ?? "Menu indisponible";
    }

    public static function getProductsForToday()
    {
        $currentDay = Carbon::now()->format('l'); // 'l' donne le jour complet, ex: "Monday"
        return Product::where('day', $currentDay)->get();
    }

    public static function getDayName($dayIndex)
    {
        return self::JOURS[$dayIndex];
    }
}


