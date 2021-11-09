<?php

namespace Library\Persisters;

use Library\Contracts\BaseRepositoryInterface;

abstract class BasePersister
{
    /**
     * The repository
     * 
     * @var BaseRepositoryInterface
     */
    protected $repo;

    /**
     * Inserts the given data in the storage
     * 
     * @param array $data
     * @return bool|array
     */
    public function insert(array $data): bool|array
    {
        $item = $this->repo->create($data);

        if(!$item) {
            return false;
        }

        return $this->normalize($item);
    }

     /**
     * Updates the data for the id in the storage
     * 
     * @param int $id
     * @param array $data
     * @return bool|array
     */
    public function update(int $id, array $data): bool|array
    {
        $item = $this->repo->update($id, $data);

        if(!$item) {
            return false;
        }

        return $this->normalize($item);
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

    /**
     * Normalizes an object to an array
     * 
     * @param object $items
     * @return array
     */
    protected function normalize(object|array $items): array
    {
        $normalized = array();

        foreach($items as $key => $item) {
            if(is_object($item)) {
                $normalized[$key] = $item->toArray();
                continue;
            }

            if(!is_array($item)) {
                $normalized[$key] = $item;
                continue;
            }

            $normalized[$key] = $this->normalize($item);
        }

        return $normalized;
    }
}
