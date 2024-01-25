<?php

namespace omairtech\laravel\base\repositories;


use Illuminate\Database\Eloquent\Model;
use omairtech\laravel\base\dtos\RequestFilter;

class BaseApiRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * @var Model $model
     */
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all with filters.
     *
     * @param RequestFilter $filter
     * @return mixed
     */
    public function getAll(RequestFilter $filter)
    {
        // Select
        $builder = $this->model->select("*");

        $filter->setTable($this->model->getTable());

        // Where Meta
        foreach ($filter->getMeta() as $column => $value) {
            $builder->where($filter->getTable() . "." . $column, '=', $value);
        }

        // Where Date
        if($date = $filter->getDate()){
            if ($fromDate = $date->getFrom()) {
                $builder->whereDate($date->getTableColumn(), '>=', $fromDate);
            }
            if ($fromTo = $date->getTo()) {
                $builder->whereDate($date->getTableColumn(), '<=', $fromTo);
            }
        }

        // Where Search
        if($search = $filter->getSearch()) {
            $builder->where(function ($query) use ($search) {
                foreach ($search->getColumns() as $index => $column) {
                    if($index > 0)
                        $query->orWhere($search->getTable() . "." . $column, "LIKE", "%". $search->getKeyword()."%");
                    $query->where($search->getTable() . "." . $column, "LIKE", "%". $search->getKeyword()."%");
                }
            });
        }

        // Sorting
        if($sort = $filter->getSort()){
            $builder->orderBy($sort->getTableColumn(), $sort->getType());
        }

        // Trashed data
        if($filter->isWithTrashed()) $builder->withTrashed();
        if($filter->isOnlyTrashed()) $builder->onlyTrashed();

        // Pagination
        if($paginate = $filter->getPaginate()){
            $builder->orderBy($sort->getTableColumn(), $sort->getType());

            $builderQuery = $builder;
            $result = $builderQuery->paginate($paginate->getPerPage());

            if ($result->isEmpty() && $result->lastPage() < $result->currentPage()) {
                $result = $builder->paginate($paginate->getPerPage(), ['*'], 'page', $result->lastPage());
            }
            return $result;
        }
        return $builder->get();
    }

    /**
     * Get by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Get by id
     *
     * @param int $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Save new data
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if ($this->addTableLog)
            $this->createdBy($data);

        $item = $this->model->create($data);
        return $item;
    }

    /**
     * Save new data
     *
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(array $where, array $data)
    {
        if ($this->addTableLog)
            $this->createdBy($data);
        return $this->model->updateOrCreate($where, $data);
    }

    /**
     * Update by id
     *
     * @param array $data
     * @param int $id
     * @param bool $restore
     * @return mixed
     */
    public function updateById(int $id, array $data, bool $restore = false)
    {
        if ($this->addTableLog)
            $this->updatedBy($data);

        if ($restore)
            $item = $this->model->withTrashed()->findOrFail($id);
        else
            $item = $this->findOrFail($id);

        if ($item) {
            if ($restore)
                $item->restore();

            $item->update($data);
        }
        return $item;
    }

    /**
     * Delete by id
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        $item = $this->findOrFail($id);
        if ($item) {
            if ($this->addTableLog)
                $item->update($this->deletedBy($item));

            $item->delete();
            // determine if a given model instance has been soft deleted, use the trashed method:
            if ($item->trashed()) {
                return true;
            }
        }
        return false;
    }
}
