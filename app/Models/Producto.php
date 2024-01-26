<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    
    protected $fillable = [
        'id_producto',
        'nombre',
        'precio',
        'stock',
        'id_categoria',
    ];
}
