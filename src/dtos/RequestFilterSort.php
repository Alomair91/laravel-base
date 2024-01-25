<?php

namespace omairtech\laravel\base\dtos;


class RequestFilterSort implements \JsonSerializable
{
    /**
     * @var string $table
     */
    private string $table;

    /**
     * @var string $column
     */
    private string $column;

    /**
     * @var string $type
     */
    private string $type;

    /**
     * @param string $column
     * @param string $type
     */
    public function __construct(string $column = "created_at", string $type = "desc")
    {
        $this->column = $column;
        $this->type = $type;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setColumn(string $column): void
    {
        $this->column = $column;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getTableColumn(): string
    {
        return $this->getTable() ."." . $this->getColumn();
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "table" => $this->getTable(),
            "column" => $this->getColumn(),
            "type" => $this->getType(),
        ];
    }
}
