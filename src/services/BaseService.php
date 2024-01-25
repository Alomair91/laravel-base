<?php

namespace omairtech\laravel\base\services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use omairtech\laravel\base\traits\DataUtils;
use omairtech\laravel\base\traits\ResponseUtils;

/*
 * This class Will do:
 * - Do transactions to database in one place
 * - validate data
 */

abstract class BaseService
{
    use ResponseUtils, DataUtils;

    /**
     * Wrap update and delete transaction
     *
     * @param callable $func
     * @return mixed
     * @throws Exception
     */
    public function dbTransaction(callable $func): mixed
    {
        try {
            DB::beginTransaction();
            $result = $func();
            DB::commit();
            return $result;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Validate before insert or update data
     *
     * @param array $data
     * @param array $rules
     * @return ?MessageBag
     */
    public function validate(array $data, array $rules): ?MessageBag
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
            return $validator->errors();
        return null;
    }
}
