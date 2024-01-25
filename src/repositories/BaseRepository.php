<?php

namespace omairtech\laravel\base\repositories;


abstract class BaseRepository
{
    protected int|string $userId;
    protected bool $addTableLog = false;


    public function createdBy(&$object)
    {
        $object['created_by'] = $this->userId;
        return $object;
    }

    public function updatedBy(&$object)
    {
        $object['updated_by'] = $this->userId;
        return $object;
    }


    public function deletedBy(&$object)
    {
        $object['deleted_by'] = $this->userId;
        return $object;
    }
}
