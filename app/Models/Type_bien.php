<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_bien extends Model
{
    use HasFactory;

    protected $table = 'Type_bien';
    protected $fillable = ['nom', 'commission'];
    
}
