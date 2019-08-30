<?php


namespace App;
use App\Model;

interface ModelInterface
{
    /**
     * @param int $limit
     * @param int $page
     * @return mixed
     */
    public function getAll(int $limit = 0, int $page = 0);

    /**
     * Creates the given model
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Updates the given model
     * @param \App\Model $model
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $model, array $attributes);

    /**
     * Deletes the given model
     * @param \App\Model $model
     * @return mixed
     */
    public function delete(Model $model);
}