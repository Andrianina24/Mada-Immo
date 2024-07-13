<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    use HasFactory;

    protected $table = 'Location';
    protected $primaryKey = 'id_location';
    protected $fillable = ['id_location', 'reference', 'id_client', 'date_deb', 'duree'];
    public $timestamps = false;

    public static function getLocation_BienById($id_location)
    {
        $model = DB::select('SELECT l.id_location,l.reference,b.loyer,t.commission,l.id_client,l.duree,l.date_deb from Location l join Bien b on l.reference=b.reference join type_bien t on b.id_type_bien=t.id_type_bien where id_location = ?', [$id_location]);
        return collect($model)->first();
    }

    public static function getLocation_Bien()
    {
        $model = DB::select('SELECT l.id_location,l.reference,l.date_deb,l.duree,b.nom,b.loyer,t.commission from location l join bien b on l.reference=b.reference join type_bien t on t.id_type_bien=b.id_type_bien');
        return collect($model);
    }

    public static function generer($id_location)
    {
        $location = Location::getLocation_BienById($id_location);
        if ($location->duree > 0) {
            $startDate = new \DateTime($location->date_deb);
            for ($i = 0; $i < $location->duree; $i++) {
                // Générer une date complète
                $date = $startDate->format('Y-m-d');

                $loyerMois = new Loyer_mois();
                $loyerMois->id_location = $id_location;
                $loyerMois->reference = $location->reference;
                if ($i == 0) {
                    $loyerMois->loyer = $location->loyer * 2;
                    $loyerMois->commission = 100;
                }
                // if($i==2){
                // $loyerMois->loyer = 0;
                // $loyerMois->commission = 0;
                // }
                else {
                    $loyerMois->loyer = $location->loyer;
                    $loyerMois->commission = $location->commission;
                }
                $loyerMois->valeur_commission = (($location->loyer) * ($loyerMois->commission)) / 100;
                $loyerMois->id_client = $location->id_client;
                $loyerMois->date = $date;
                $loyerMois->save();

                $startDate->modify('+1 month');
            }
        }
    }
}
