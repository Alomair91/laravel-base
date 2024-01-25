<?php

namespace omairtech\laravel\base\controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use omairtech\laravel\base\services\BaseApiService;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var BaseApiService $service
     */
    protected BaseApiService $service;

    /**
     * BaseController Constructor
     * @param BaseApiService $service
     */
    public function __construct(BaseApiService $service)
    {
        $this->service = $service;
    }
}
