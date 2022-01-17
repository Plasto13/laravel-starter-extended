<?php

namespace Modules\Core\Services;

use Modules\Core\Repositories\BaseRepository;

class NestedServices
{
     /**
     * @var Repository
     */
    private $repository;

    /**
     * @param BaseRepository $repository
     */
    public function __construct()
    {
    }

    /**
     * @param $data
     */
    public function handle(BaseRepository $repository, $data)
    {
        $this->repository = $repository;
        $data = $this->convertToArray($data);

        foreach ($data as $position => $item) {
            $this->order($position, $item);
        }
    }

    /**
     * Order recursively the menu items
     * @param int   $position
     * @param array $item
     */
    private function order($position, $item)
    {
        $itm = $this->repository->find($item['id']);
        // if (0 === $position && false === $itm->isRoot()) {
        //     return;
        // }
        $this->savePosition($itm, $position);
        $this->makeItemChildOf($itm, null);

        if ($this->hasChildren($item)) {
            $this->handleChildrenForParent($itm, $item['children']);
        }
    }

    /**
     * @param Menuitem $parent
     * @param array    $children
     */
    private function handleChildrenForParent($parent, array $children)
    {
        foreach ($children as $position => $item) {
            $itm = $this->repository->find($item['id']);
            $this->savePosition($itm, $position);
            $this->makeItemChildOf($itm, $parent->id);

            if ($this->hasChildren($item)) {
                $this->handleChildrenForParent($itm, $item['children']);
            }
        }
    }

    /**
     * Save the given position on the menu item
     * @param object $item
     * @param int    $position
     */
    private function savePosition($item, $position)
    {
        $this->repository->update($item, compact('position'));
    }

    /**
     * Check if the item has children
     *
     * @param  array $item
     * @return bool
     */
    private function hasChildren($item)
    {
        return isset($item['children']);
    }

    /**
     * Set the given parent id on the given menu item
     *
     * @param object $item
     * @param int    $parent_id
     */
    private function makeItemChildOf($item, $parent_id)
    {
        $this->repository->update($item, compact('parent_id'));
    }

    /**
     * Convert the object to array
     * @param $data
     * @return array
     */
    private function convertToArray($data)
    {
        $data = json_decode(json_encode($data), true);

        return $data;
    }
   
}
