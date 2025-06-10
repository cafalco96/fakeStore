<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = [
        'users_id',
        'estado',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function carritoProductos() {
        return $this->hasMany(CarritoProducto::class);
    }
}
