<?php

namespace omairtech\laravel\base\dtos;


/*
 {
    "table": "users",
    "select": ["id","name", "email", "created_at"],
    "meta: [
        "emil": "me@gmail.com"
    ]
    "sort": {
        "type": "asc",
        "column": "created_at"
    },
    "date": {
        "from": "2024-01-01",
        "to": "2024-01-11",
        "column": "created_at"
    },
    "search": {
        "keyword": "me",
        "columns": ["name", "email"]
    },
    "paginate": {
        "page": 1,
        "perPage": 10
    },
    "withTrashed": true,
    "onlyTrashed": false,
 }
 */

class RequestFilter implements \JsonSerializable
{
    /**
     * @var string $table
     */
    private string $table;

    /**
     * @var array $select
     */
    private array $select = ["*"];

    /**
     * @var array $meta
     */
    private array $meta;

    /**
     * @var RequestFilterSort $sort
     */
    private RequestFilterSort $sort;

    /**
     * @var ?RequestFilterDate $date
     */
    private ?RequestFilterDate $date;

    /**
     * @var ?RequestFilterSearch $search
     */
    private ?RequestFilterSearch $search;

    /**
     * @var RequestFilterPaginate $paginate
     */
    private RequestFilterPaginate $paginate;

    private bool $withTrashed = false;
    private bool $onlyTrashed = false;

    /**
     * @param string $table
     * @param array $meta
     * @param RequestFilterSort $sort
     * @param ?RequestFilterDate $date
     * @param ?RequestFilterSearch $search
     * @param RequestFilterPaginate $paginate
     */
    public function __construct(string $table,
                                array $meta = [],
                                RequestFilterSort $sort = new RequestFilterSort(),
                                RequestFilterDate $date = null,
                                RequestFilterSearch $search = null,
                                RequestFilterPaginate $paginate = new RequestFilterPaginate())
    {
        $this->meta = $meta;
        $this->sort = $sort;
        $this->date = $date;
        $this->search = $search;
        $this->paginate = $paginate;
        $this->setTable($table);
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
        $this->sort?->setTable($table);
        $this->date?->setTable($table);
        $this->search?->setTable($table);
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setSelect(array $select): void
    {
        $this->select = $select;
    }

    public function getSelect(): array
    {
        return $this->select;
    }

    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setSort(RequestFilterSort $sort): void
    {
        $this->sort = $sort;
    }

    public function getSort(): RequestFilterSort
    {
        return $this->sort;
    }

    public function setDate(RequestFilterDate $date): void
    {
        $this->date = $date;
    }

    public function getDate(): RequestFilterDate
    {
        return $this->date;
    }

    public function setSearch(?RequestFilterSearch $search): void
    {
        $this->search = $search;
    }

    public function getSearch(): ?RequestFilterSearch
    {
        return $this->search;
    }

    public function setPaginate(RequestFilterPaginate $paginate): void
    {
        $this->paginate = $paginate;
    }

    public function getPaginate(): RequestFilterPaginate
    {
        return $this->paginate;
    }

    public function setWithTrashed(bool $withTrashed): void
    {
        $this->withTrashed = $withTrashed;
    }

    public function isWithTrashed(): bool
    {
        return $this->withTrashed;
    }

    public function setOnlyTrashed(bool $onlyTrashed): void
    {
        $this->onlyTrashed = $onlyTrashed;
    }

    public function isOnlyTrashed(): bool
    {
        return $this->onlyTrashed;
    }


    public function jsonSerialize()
    {
        return [
            "tableName" => $this->getTable(),
            "meta" => $this->getMeta(),
            "sort" => $this->getSort(),
            "date" => $this->getDate(),
            "search" => $this->getSearch(),
            "paginate" => $this->getPaginate(),
            "withTrashed" => $this->isWithTrashed(),
            "onlyTrashed" => $this->isOnlyTrashed(),
        ];
    }
}
