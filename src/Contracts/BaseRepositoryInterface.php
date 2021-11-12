<?php

namespace Library\Contracts;

interface BaseRepositoryInterface
{
    /**
     * Returns all the items
     * 
     * @return object;
     */
    public function all(): array;

    /**
     * Finds the resource for the given id
     * 
     * @param int $id
     * @return object
     */
    public function find(int $id): object|null;

    /**
     * Creates a new resource
     * 
     * @param array $data
     * @return bool|object
     */
    public function create(array $data): bool|object;

    /**
     * Updates the resource for the given id
     * 
     * @param int $id
     * @param array $data
     * @return bool|object
     */
    public function update(int $id, array $data): bool|object;

    /**
     * Deletes the resource for the given id
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Soft deletes the resource for the given id
     * 
     * @param int $id
     * @return bool
     */
    public function archive(int $id): bool;
}
