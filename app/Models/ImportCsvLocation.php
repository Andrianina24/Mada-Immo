<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportCsvLocation extends Model
{
    use HasFactory;

    protected $table = 'import_location';
    public $timestamps = false;

    protected $fillable = ['reference', 'date_debut', 'duree_mois', 'client'];

    public function importData()
    {
        // Insertion des nouveaux clients
        DB::insert('INSERT INTO client(mail) 
            SELECT DISTINCT client
            FROM import_location
        ');

        // Insertion des nouvelles locations
        DB::insert('
            INSERT INTO Location(reference, date_deb, duree, id_client)
            SELECT il.reference, il.date_debut, il.duree_mois, c.id_client
            FROM import_location il
            JOIN client c ON il.client = c.mail
        ');

        // Récupérer les id_location insérés récemment
        $locations = DB::select('
            SELECT l.id_location
            FROM Location l
            JOIN import_location il ON l.reference = il.reference AND l.date_deb = il.date_debut AND l.duree = il.duree_mois
            JOIN client c ON l.id_client = c.id_client AND il.client = c.mail
        ');

        // Parcourir les id_location et générer les loyers mensuels
        foreach ($locations as $location) {
            Location::generer($location->id_location);
        }
    }
}
