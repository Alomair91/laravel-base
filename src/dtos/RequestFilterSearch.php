<?php

namespace omairtech\laravel\base\dtos;


class RequestFilterSearch implements \JsonSerializable
{
    /**
     * @var string $table
     */
    private string $table;

    /**
     * @var array $columns
     */
    private array $columns;

    /**
     * @var string $keyword
     */
    private string $keyword;

    /**
     * @param array $columns
     * @param string $keyword
     */
    public function __construct(array $columns, string $keyword)
    {
        $this->columns = $columns;
        $this->keyword = $keyword;
    }


    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }


    public function jsonSerialize(): mixed
    {
        return [
            "table" => $this->getTable(),
            "columns" => $this->getColumns(),
            "keyword" => $this->getKeyword(),
        ];
    }
}
