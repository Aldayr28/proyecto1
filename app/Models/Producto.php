<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    
    use HasFactory; 
    
    protected $fillable = ['nombre', 'precio', 'stock', 'precisal', 'config', 'user_id'];

    // Relación inversa: un producto pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
