<?php

namespace omairtech\laravel\base\mappers;

use Illuminate\Http\Request;
use omairtech\laravel\base\dtos\RequestFilter;
use omairtech\laravel\base\dtos\RequestFilterPaginate;
use omairtech\laravel\base\dtos\RequestFilterSort;

class RequestFilterMapper
{
    public static function fromRequest(Request $request,string $table = null) : RequestFilter
    {
        $filter = new RequestFilter($request->get("table", $table));
        $filter->setSelect($request->get("select", ["*"]));
        $filter->setMeta($request->get("meta", []));
        $filter->setSort($request->get("sort", new RequestFilterSort()));
        $filter->setDate($request->get("date", null));
        $filter->setSearch($request->get("search", null));
        $filter->setPaginate($request->get("paginate", new RequestFilterPaginate()));
        $filter->setWithTrashed($request->get("withTrashed", false));
        $filter->setOnlyTrashed($request->get("onlyTrashed", false));
        return $filter;
    }
}
