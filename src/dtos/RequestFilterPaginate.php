<?php

namespace omairtech\laravel\base\dtos;


class RequestFilterPaginate implements \JsonSerializable
{
    /**
     * @var int $page
     */
    private int $page;

    /**
     * @var int $perPage
     */
    private int $perPage;

    /**
     * @param int $page
     * @param int $perPage
     */
    public function __construct(int $page = 1, int $perPage = 20)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    public function getPerPage(): int
    {
        return $this->perPage <= 0 ? 20 : $this->perPage;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "page" => $this->getPage(),
            "perPage" => $this->getPerPage(),
        ];
    }
}
