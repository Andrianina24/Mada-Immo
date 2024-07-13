<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $table = 'Client';
    protected $fillable = ['id_client', 'nom', 'mail'];

    public static function getLoyerClient($id_client, $date1, $date2)
    {
        $model = DB::select(
            'select id_client,DATE_FORMAT(date, "%Y-%m") as month,MONTHNAME(date) as month_name,sum(loyer) as loyer from Loyer_mois 
            where id_client= ? and DATE_FORMAT(date, "%Y-%m") between DATE_FORMAT(?, "%Y-%m") and DATE_FORMAT(?, "%Y-%m") group by month',
            [$id_client, $date1, $date2]
        );
        return collect($model);
    }

    public static function login($mail)
    {
        return self::where('mail', $mail)->first();
    }

}
