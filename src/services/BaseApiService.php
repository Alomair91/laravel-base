<?php

namespace omairtech\laravel\base\services;

use Illuminate\Http\JsonResponse;
use omairtech\laravel\base\mappers\RequestFilterMapper;
use omairtech\laravel\base\repositories\BaseApiRepository;
use omairtech\laravel\base\requests\BaseRequest;

/*
 * This class Will do:
 * - return CRUD response
 */

abstract class BaseApiService extends BaseService implements ServiceInterface
{
    public BaseApiRepository $repository;

    /**
     * BaseApiService constructor.
     *
     * @param BaseApiRepository $repository
     */
    public function __construct(BaseApiRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all items.
     *
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function index(BaseRequest $request): JsonResponse
    {
        $filter = RequestFilterMapper::fromRequest($request);
        if ($result = $this->repository->getAll($filter)) {
            return $this->responseSuccess($request, $result);
        }
        return parent::responseErrorThereIsNoData();
    }

    /**
     * Get item by id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(BaseRequest $request, int $id): JsonResponse
    {
        if ($result = $this->repository->getById($id))
            return $this->responseData($result);
        return parent::responseErrorThereIsNoData();
    }


    /**
     * Validate  data.
     * Store to DB if there are no errors.
     *
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function store(BaseRequest $request): JsonResponse
    {
        $result = $this->repository->create($request->all());
        if (!$result)
            return $this->responseErrorCanNotSaveData();

        return $this->responseData($result);
    }

    /**
     * Update  data  by id
     * Store to DB if there are no errors.
     *
     * @param BaseRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(BaseRequest $request, int $id): JsonResponse
    {
        $result = $this->dbTransaction(function () use ($id, $request) {
            return $this->repository->updateById($id, $request->all(), $request->get("restore", false));
        });
        if ($result)
            return $this->responseData($result);
        return $this->responseErrorThereIsNoData();
    }

    /**
     * Delete item by id.
     *
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(BaseRequest $request, int $id): JsonResponse
    {
        $result = $this->dbTransaction(function () use ($id) {
            return $this->repository->deleteById($id);
        });

        if ($result)
            return $this->responseData($result);

        return $this->responseErrorThereIsNoData();
    }
}
