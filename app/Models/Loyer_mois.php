<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Loyer_mois extends Model
{
    use HasFactory;

    protected $table = 'Loyer_mois';
    protected $fillable = ['id_location', 'reference', 'loyer', 'commission', 'valeur_commission', 'id_client', 'date'];
    public $timestamps = false;

    public static function details($id_location)
    {
        $model = DB::select('SELECT l.reference,b.nom,sum(l.loyer) as loyer,l.commission,l.date,MONTHNAME(l.date) as mois,case
            when l.date<"2024-08-01" then "green"
            else "yellow"
            end as color
        from loyer_mois l join bien b on l.reference=b.reference where id_location=? group by l.date', [$id_location]);
        return collect($model);
    }
}
