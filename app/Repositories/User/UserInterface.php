<?php


namespace App\Repositories;
use App\/Models/User;

interface UserInterface
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
     * @param \App\User $user
     * @param array $attributes
     * @return mixed
     */
    public function update(User $user, array $attributes);

    /**
     * Deletes the given model
     * @param \App\User $user
     * @return mixed
     */
    public function delete(User $user);
}