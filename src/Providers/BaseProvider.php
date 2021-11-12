<?php

namespace Library\Providers;

use Library\Contracts\BaseRepositoryInterface;

abstract class BaseProvider
{
    /**
     * The repository
     * 
     * @var BaseRepositoryInterface
     */
    protected $repo;

    public function all(): array
    {
        $items = $this->repo->all();

        return $this->normalize($items);
    }

    public function find(int $id): array
    {
        $item = $this->repo->find($id);

        if(is_null($item)) {
            return [];
        }

        return $this->normalize($item);
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

        if(is_object($items)) {
            return $items->toArray();
        }

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
