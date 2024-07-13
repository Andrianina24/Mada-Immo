<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportCsvBiens extends Model
{
    use HasFactory;
    protected $table= 'import_bien';
    public $timestamps= false;

    protected $fillable =['reference','nom','description','type','region','loyer','proprietaire'];

    public function importData(){
        DB::insert('INSERT into proprietaire(numero) 
        SELECT DISTINCT proprietaire
        FROM import_bien
        ');

        DB::insert('INSERT into bien(reference,nom,descri,id_type_bien,region,loyer,id_proprietaire)
        SELECT ib.reference,ib.nom,ib.description,tb.id_type_bien,ib.region,ib.loyer,p.id_proprietaire
        FROM import_bien ib
        JOIN type_bien tb
        ON ib.type=tb.nom
        JOIN proprietaire p
        ON ib.proprietaire=p.numero
        ');
    }
}
