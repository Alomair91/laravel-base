<?php

namespace omairtech\laravel\base\repositories;

use omairtech\laravel\base\dtos\RequestFilter;

interface  RepositoryInterface
{

    /**
     * Get all items with some filter
     *
     * @param RequestFilter $filter
     * @return mixed
     */
    public function getAll(RequestFilter $filter);

    /**
     * Get item by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Store new item
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update item
     *
     * @param int $id
     * @param array $data
     * @param bool $restore
     * @return mixed
     */
    public function updateById(int $id, array $data,bool $restore = false);


    /**
     * Delete item
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);

}
