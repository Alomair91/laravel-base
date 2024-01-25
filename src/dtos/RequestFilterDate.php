<?php

namespace omairtech\laravel\base\dtos;


class RequestFilterDate implements \JsonSerializable
{
    /**
     * @var string $table
     */
    private string $table;

    /**
     * @var string $from
     */
    private string $from;

    /**
     * @var string $to
     */
    private string $to;

    /**
     * @var string $column
     */
    private string $column;

    /**
     * @param $from
     * @param $to
     * @param string $column
     */
    public function __construct(string $from = null, string $to = null, string $column = "created_at")
    {
        $this->from = $from;
        $this->to = $to;
        $this->column = $column;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function setFrom(string $from): void
    {
        $this->from = $from;
    }

    public function setTo(string $to): void
    {
        $this->to = $to;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function setColumn(string $column): void
    {
        $this->column = $column;
    }

    public function getTableColumn(): string
    {
        return $this->getTable() ."." . $this->getColumn();
    }


    public function jsonSerialize(): mixed
    {
        return [
            "table" => $this->getTable(),
            "from" => $this->getFrom(),
            "to" => $this->getTo(),
            "column" => $this->getColumn(),
        ];
    }
}
