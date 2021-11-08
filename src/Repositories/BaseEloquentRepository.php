<?php

namespace Library\Repositories;

use Library\Contracts\RepositoryInterface;

abstract class BaseEloquentRepository implements RepositoryInterface
{
    /**
     * The model namespace
     * 
     */
    protected $model;

    /**
     * Returns all the items
     * 
     * @return object;
     */
    public function all(): object
    {
        $items = $this->model::all();

        return $items;
    }

    /**
     * Finds the resource for the given id
     * 
     * @param int $id
     * @return object
     */
    public function find(int $id): object
    {
        $item = $this->model::find($id);

        return $item;
    }

    /**
     * Creates a new resource
     * 
     * @param array $data
     * @return bool
     */
    public function create(array $data = array()): bool
    {
        $item = $this->model::create($data);

        return $item->fresh();
    }

    /**
     * Updates the resource for the given id
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data = array()): bool
    {
        $item = $this->model::find($id);

        if(!$item) {
            return false;
        }

        $item->fill($data);
        $item->save();

        return true;
    }

    /**
     * Deletes the resource for the given id
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $item = $this->model::find($id);

        if(!$item) {
            return false;
        }

        $item->forceDelete();

        return true;
    }

    /**
     * Soft deletes the resource for the given id
     * 
     * @param int $id
     * @return bool
     */
    public function archive(int $id): bool
    {
        $item = $this->model::find($id);

        if(!$item) {
            return false;
        }

        $item->delete();

        return true;
    }
}
