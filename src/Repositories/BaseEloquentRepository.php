<?php

namespace Library\Repositories;

use Illuminate\Database\Eloquent\Model;
use Library\Contracts\BaseRepositoryInterface;

abstract class BaseEloquentRepository implements BaseRepositoryInterface
{
    /**
     * The model
     * 
     * @var Model
     */
    protected $model;

    /**
     * The model relationships to eager load
     * 
     * @var array
     */
    protected $with = array();

    /**
     * Returns all the items
     * 
     * @return object;
     */
    public function all(): array
    {
        $items = $this->model::with($this->with)->get();

        return $items->all();
    }

    /**
     * Finds the resource for the given id
     * 
     * @param int $id
     * @return object
     */
    public function find(int $id): object|null
    {
        return $this->model::with($this->with)->find($id);
    }

    /**
     * Creates a new resource
     * 
     * @param array $data
     * @return bool|object
     */
    public function create(array $data = array()): bool|object
    {
        $item = $this->model::create($data);

        if(!$item) {
            return false;
        }
        
        return $item->fresh()->load($this->with);
    }

    /**
     * Updates the resource for the given id
     * 
     * @param int $id
     * @param array $data
     * @return bool|object
     */
    public function update(int $id, array $data = array()): bool|object
    {
        $item = $this->model::find($id);

        if(!$item) {
            return false;
        }

        $item->fill($data);
        $item->save();

        return $item->fresh()->load($this->with);
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
