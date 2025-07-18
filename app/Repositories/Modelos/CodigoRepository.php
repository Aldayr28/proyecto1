<?php
namespace App\Repositories;

use App\Models\Codigo; //estamos diciendo que vamos a usar el modelo Codigo
use Carbon\Carbon; //importamos la clase carbon para manejar fechas

class CodigoRepository
{
    public function obtenerDisponibles()
    {
        return Codigo::where('usado', false)
                     ->where('fecha_vencimiento', '>=', Carbon::now())
                     ->get();
    }
    // Método para obtener códigos vencidos
    public function obtenerCodigosVencidos() //este es un metodo publico vamos a llamar desde el Service o el Controller
    {
        return Codigo::where('fecha_vencimiento', '<', Carbon::now())
        ->get();
        //Busca en la tabla codigo el campo fecha_vencimiento y quiere que muestre las fechas menores a la fecha actual
    }
}
