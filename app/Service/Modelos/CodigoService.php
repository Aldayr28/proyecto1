<?php
namespace App\Services;

use App\Repositories\CodigoRepository;
//usamos el repositorio el archivo CodigoRepository para obtener el acceso a los datos

class CodigoService
{
    protected $codigoRepository;

    public function __construct(CodigoRepository $codigoRepository)
    {
        $this->codigoRepository = $codigoRepository;
    }

    public function listarDisponibles()
    {
        return $this->codigoRepository->obtenerDisponibles();
    }
    public function obtenerCodigosVencidos()
    {
        return $this->codigoRepository->obtenerCodigosVencidos();
        //llamamos al repositorio "codigoRepository" y al metodo->obtenerCodigoVnds para devolver los datos
    }
}
