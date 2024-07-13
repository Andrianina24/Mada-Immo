<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    use HasFactory;
    public static function reinitialiser()
    {
        DB::table('Loyer_mois')->delete();
        DB::table('Location')->delete();
        DB::table('Bien')->delete();
        DB::table('Type_bien')->delete();
        DB::table('Client')->delete();
        DB::table('Proprietaire')->delete();
    
        return true;
    }

}
