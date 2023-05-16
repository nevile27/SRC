<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donnee extends Model
{
    use HasFactory;

	protected $fillable = ['airline','avail_seat_km_per_week','incidents_85_99','fatal_accidents_85_99','fatalities_85_99','incidents_00_14','fatal_accidents_00_14','fatalities_00_14',];

}
