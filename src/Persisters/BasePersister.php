<?php

namespace Library\Persisters;

use Library\RepositoryInterface;

abstract class BasePersister
{
    /**
     * The repository
     * 
     * @var RepositoryInterface
     */
    protected $repo;

    /**
     * Inserts the given data in the storage
     * 
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->repo->create($data);
    }

     /**
     * Updates the data for the id in the storage
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->repo->update($id, $data);
    }

     /**
     * Deletes the given id from the storage
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
    
    /**
     * Archives the given id in storage
     * 
     * @param int $id
     * @return bool
     */
    public function archive(int $id): bool
    {
        return $this->repo->archive($id);
    }
}
