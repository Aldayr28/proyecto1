<?php

namespace App\Repositories\Models;

use App\Contracts\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    /** @var Model */
    protected $model;

    /** @var array */
    protected $relations;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model, array $relations = [])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    /**
     * Recuperar todos los registros, opcionalmente con relaciones.
     */
    public function all(): Collection
    {
        return $this->applyRelations($this->model)->get();
    }

    /**
     * Busque un registro por ID, opcionalmente con relaciones.
     */
    public function find(int $id): ?Model
    {
        return $this->applyRelations($this->model)->find($id);
    }

    /**
     * Crear un nuevo registro en la base de datos.
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Actualizar un registro en la base de datos.
     *
     * @param  Model  $model
     */
    public function update($model, array $data): bool
    {
        return $model->update($data);
    }

    /**
     * Eliminar un registro de la base de datos.
     *
     * @param  Model  $model
     */
    public function delete($model): ?bool
    {
        return $model->delete();
    }

    /**
     * Paginar los registros, opcionalmente con relaciones.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->applyRelations($this->model)->paginate($perPage);
    }

    /**
     * Paginación simple (sin recuento total), opcionalmente con relaciones.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function simplePaginate(int $perPage = 10)
    {
        return $this->applyRelations($this->model)->simplePaginate($perPage);
    }

    /**
     * Aplicar las relaciones especificadas a la consulta si están disponibles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyRelations(Model $model)
    {
        $query = $model->newQuery();
        if (! empty($this->relations)) {
            $query->with($this->relations);
        }

        return $query;
    }

    public function exists(array $conditions): bool
    {
        return $this->model->where($conditions)->exists();
    }

    /**
     * Realice una búsqueda utilizando Scout, si está disponible.
     */
    public function search(string $query, $perPage = 10): Collection|LengthAwarePaginator
    {
        if (method_exists($this->model, 'search')) {
            $builder = $this->model::search($query);

            $results = $builder->paginate($perPage);
            if ($results->isEmpty()) {
                return new Collection([]);
            }

            if (! empty($this->relations)) {
                $results->load($this->relations);
            }

            return $results;
        }

        return new Collection([]);
    }

    /**
     * Recuperar usuarios que no tengan ninguna de las relaciones especificadas.
     *
     * @param  array  $relations  An array of relation names to check.
     * @return \Illuminate\Database\Eloquent\Collection A collection of users without the specified relations.
     */
    public function getNoRelations(array $relations)
    {
        $query = $this->model->newQuery();
        foreach ($relations as $relation) {
            $query->doesntHave($relation);
        }

        return $query->get();
    }

    /**
     * Recuperar usuarios que tengan todas las relaciones especificadas.
     *
     * @param  array  $relations  An array of relation names to check.
     * @return \Illuminate\Database\Eloquent\Collection A collection of users with the specified relations.
     */
    public function getWithRelations(array $relations)
    {
        $query = $this->model->newQuery();
        foreach ($relations as $relation) {
            $query->has($relation);
        }

        return $query->get();
    }

    public function cleanData(array $data, array $map)
    {
        foreach ($map as $from => $to) {
            if (isset($data[$from])) {
                $data[$to] = $data[$from];
                unset($data[$from]);
            }
        }

        return $data;
    }
}