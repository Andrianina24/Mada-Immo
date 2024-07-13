<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ImportCsvCommission extends Model
{
    use HasFactory;

    protected $table= 'import_commission';
    public $timestamps= false;

    protected $fillable= ['type','commission'];

    public function importData(){
        DB::insert('INSERT into type_bien(nom,commission)
        SELECT DISTINCT Type,Commission
        FROM import_commission
        ');
    }
}
