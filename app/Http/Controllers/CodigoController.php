<?php
namespace App\Http\Controllers;

use App\Services\CodigoService; //estamos llamando el archivo CodigoService

class CodigoController extends Controller
{
    protected $codigoService;

    public function __construct(CodigoService $codigoService) //poner el servicio para usarlo
    {
        $this->codigoService = $codigoService;
    }

    public function disponibles()
    {
        $codigos = $this->codigoService->listarDisponibles();
        return response()->json($codigos);
    }
    public function codigosVencidos()//nuevo metodo
    {
        $codigos = $this->codigoService->obtenerCodigosVencidos();
        //llamamos al metodo obtenerCodigosVencidos() que esta en el archivo CodigoService y se almacena en $codigos
        return response()->json($codigos);
        //devolvemos los resultados en formato JSON
    }
}
