<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bien extends Model
{
    use HasFactory;

    protected $table = 'Bien';
    protected $fillable = ['id_bien', 'nom', 'descri', 'region', 'loyer', 'photos', 'id_type_bien', 'id_proprietaire'];

    public static function getChiffre($date1, $date2)
    {
        $model = DB::select(
            'select *,MONTHNAME(date) as month_name,sum(loyer) as chiffre 
        from Loyer_mois where DATE_FORMAT(date, "%Y-%m") between DATE_FORMAT(?, "%Y-%m") and DATE_FORMAT(?, "%Y-%m") group by DATE_FORMAT(date, "%Y-%m")',
            [$date1, $date2]
        );
        return collect($model);
    }

    public static function getGain($date1, $date2)
    {
        $model = DB::select(
            'select *, sum(valeur_commission) as gain 
            from Loyer_mois where DATE_FORMAT(date, "%Y-%m") between  DATE_FORMAT(?, "%Y-%m") and DATE_FORMAT(?, "%Y-%m") group by DATE_FORMAT(date, "%Y-%m")',
            [$date1, $date2]
        );
        return collect($model);
    }

}
