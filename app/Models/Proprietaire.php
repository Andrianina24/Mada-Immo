<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proprietaire extends Model
{
    use HasFactory;
    protected $table = 'Proprietaire';
    protected $fillable = ['id_proprietaire', 'nom', 'numero'];

    public static function login($numero)
    {
        return self::where('numero', $numero)->first();
    }

    public static function findPropriete($id_proprietaire)
    {
        $model = DB::select(
            'select b.*,MAX(l.date) as disponible
        from Bien b join loyer_mois l on b.reference=l.reference where id_proprietaire=? group by b.reference',
            [$id_proprietaire]
        );
        return collect($model);
    }

    public static function getChiffre($date1, $date2, $id_proprietaire)
    {
        $model = DB::select(
                'SELECT (SUM(l.loyer) - SUM(l.valeur_commission)) as chiffre
                from Loyer_mois l JOIN Bien b on l.reference=b.reference 
                where DATE_FORMAT(l.date, "%Y-%m") between DATE_FORMAT(?, "%Y-%m") and DATE_FORMAT(?, "%Y-%m") and b.id_proprietaire= ?',
            [$date1, $date2, $id_proprietaire]
        );

        // Assurez-vous de retourner uniquement le chiffre (premier résultat attendu)
        if (isset($model[0]->chiffre)) {
            return $model[0]->chiffre;
        }

        return null; // Retourner null si aucun résultat trouvé
    }
}
