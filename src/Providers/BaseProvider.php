<?php

namespace Library\Providers;

abstract class BaseProvider
{
    /**
     * The repository class
     * 
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

        return $this->normalize($item);
    }

    /**
     * Normalizes an object to an array
     * 
     * @param object $items
     * @return array
     */
    protected function normalize(object $items): array
    {
        $normalized = array();

        foreach($items as $key => $item) {
            if(!is_object($item) or !is_array($item)) {
                $normalized[$key] = $item;
                continue;
            }

            $normalized[$key] = $this->normalize($item);
        }

        return $normalized;
    }
}
