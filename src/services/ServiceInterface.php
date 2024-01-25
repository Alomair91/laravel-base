<?php

namespace omairtech\laravel\base\services;

use Illuminate\Http\JsonResponse;
use omairtech\laravel\base\dtos\Response;
use omairtech\laravel\base\requests\BaseRequest;

interface ServiceInterface
{

    /**
     * Display a listing of the resource with some filters.
     *
     * @param BaseRequest $request
     * @return Response|JsonResponse
     */
    public function index(BaseRequest $request): Response|JsonResponse;

    /**
     * Show the specified resource by id.
     *
     * @param BaseRequest $request
     * @param int $id
     * @return Response|JsonResponse
     */
    public function show(BaseRequest $request,int $id): Response|JsonResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param BaseRequest $request
     * @return Response|JsonResponse
     */
    public function store(BaseRequest $request): Response|JsonResponse;

    /**
     * Update the specified resource in storage.
     *
     * @param BaseRequest $request
     * @param int $id
     * @return Response|JsonResponse
     */
    public function update(BaseRequest $request,int $id): Response|JsonResponse;

    /**
     * Remove the specified resource from storage.
     *
     * @param BaseRequest $request
     * @param int $id
     * @return Response|JsonResponse
     */
    public function destroy(BaseRequest $request,int $id): Response|JsonResponse;

}
