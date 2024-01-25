<?php

namespace omairtech\laravel\base\traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use omairtech\laravel\base\dtos\Response;
use omairtech\laravel\base\enums\HttpStatus;

trait ResponseUtils
{
    protected function response(): Response
    {
        return (new Response());
    }

    // =================================================================================================================
    // Main response method
    // =================================================================================================================

    public function responseData($data, $status = HttpStatus::OK): Response|JsonResponse{
        return $this->response()->setData($data)->setStatus($status)->json();
    }
    public function responseFromPaginator(LengthAwarePaginator $paginator): JsonResponse
    {
        return $this->response()
            ->setData($paginator->items())
            ->setMeta([
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'path' => $paginator->path(),
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total(),
            ])
            ->json();
    }

    public function responseSuccess($request, $result): JsonResponse|Response
    {
        if ($request->has("paginate")) {
            return $this->responseFromPaginator($result);
        } else {
            return $this->responseData($result);
        }
    }

    public function responseErrors($errors, $status = HttpStatus::ERROR): Response|JsonResponse{
        return $this->response()->setErrors($errors)->setStatus($status)->json();
    }

    public function responseMessage($errors, $status = HttpStatus::OK): JsonResponse{
        return $this->response()->setMessage($errors)->setStatus($status)->json();
    }


    // =================================================================================================================
    // Helper response method
    // =================================================================================================================

    public function responseSuccessMessage($message): JsonResponse
    {
        return $this->responseMessage($message,HttpStatus::OK);
    }
    public function responseErrorMessage($message): JsonResponse
    {
        return $this->responseMessage($message,HttpStatus::ERROR);
    }

    // Data Error
    public function responseErrorThereIsNoData(): JsonResponse
    {
        return self::responseErrorMessage(trans('There is no data found'));
    }
    public function responseErrorCanNotSaveData(): JsonResponse
    {
        return self::responseErrorMessage(trans('Can not save this data'));
    }
    public function responseErrorCanNotDeleteData(): JsonResponse
    {
        return self::responseErrorMessage(trans('Can not delete this record'));
    }

    // Validator Error
    public function responseValidatorObject($errors): Response|JsonResponse
    {
        return $this->responseErrors($errors,HttpStatus::VALIDATION_ERROR);
    }
    public function responseValidatorKeyValue($Key, $value): JsonResponse
    {
        return $this->responseErrors([$Key => [$value]],HttpStatus::VALIDATION_ERROR);
    }


    // Access Error
    public function responseUnauthorized(): JsonResponse
    {
        return $this->responseMessage(trans('Access Denied!'), HttpStatus::UNAUTHORIZED);
    }
    public function responseForbidden(): JsonResponse
    {
        return $this->responseMessage(trans('Access Denied!'), HttpStatus::FORBIDDEN);
    }
}
