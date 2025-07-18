<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    /** @use HasFactory<\Database\Factories\CodigoFactory> */
    use HasFactory;
    protected $fillable = ['codigo','descripcion','usado','fecha_vencimiento',];
}
