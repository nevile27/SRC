<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donnee extends Model
{
    use HasFactory;

	protected $fillable = ['country','beer_servings','spirit_servings','wine_servings','total_litres_of_pure_alcohol',];

}
