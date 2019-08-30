<?php


namespace App;
use App\Model;


class ModelEloquent implements ModelInterface
{
    private $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $limit
     * @param int $page
     * @return mixed
     */
    public function getAll(int $limit = 0, int $page = 0)
    {
        // TODO: Implement getAll() method.
    }

    /**
     * Creates the given model
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    /**
     * Updates the given model
     * @param \App\Model $model
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $model, array $attributes)
    {
        // TODO: Implement update() method.
    }

    /**
     * Deletes the given model
     * @param \App\Model $model
     * @return mixed
     */
    public function delete(Model $model)
    {
        // TODO: Implement delete() method.
    }
}