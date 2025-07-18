<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    /**
     * Obtenga todos los registros.
     */
    public function all(): Collection;

    /**
     * Busque un registro por su ID.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id);

    /**
     * Buscar un registro por un valor de columna específico.
     *
     * @param  string  $column
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    /**
     * Crear un nuevo registro.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update an existing record.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return bool
     */
    public function update($model, array $data);

    /**
     * Delete a record.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return bool
     */
    public function delete($model);
}