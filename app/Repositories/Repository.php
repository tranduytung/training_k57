<?php

namespace App\Repositories;

use App\Contracts\Collection;
use App\Contracts\CriteriaInterface;
use App\Contracts\RepositoryInterface;
use App\Exceptions\RepositoryException;
use Illuminate\Contracts\Container\Container as Application;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;
    protected $criteria;
    protected $skipCriteria = false;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify model class name
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * @return Model
     * @throws RepositoryException
     */
    protected function makeModel()
    {
        $model = $this->app->make($this->model());

        if ($model instanceof Model) {
            // TODO: exception message
            throw new RepositoryException();
        }

        return $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        $this->applyCriteria();

        if ($this->model instanceof Builder) {
        }
    }

    /**
     * @param $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = ['*'])
    {
        // TODO: Implement paginate() method.
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param array $data
     * @return bool
     */
    public function saveModel(array $data)
    {
        // TODO: Implement saveModel() method.
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        // TODO: Implement find() method.
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($field, $value, $columns = ['*'])
    {
        // TODO: Implement findAllBy() method.
    }

    /**
     * @param $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere($where, $columns = ['*'])
    {
        // TODO: Implement findWhere() method.
    }

    /**
     * Push Criteria for filter the query
     *
     * @param $criteria
     *
     * @return $this
     */
    public function pushCriteria($criteria)
    {
        // TODO: Implement pushCriteria() method.
    }

    /**
     * Pop Criteria
     *
     * @param $criteria
     *
     * @return $this
     */
    public function popCriteria($criteria)
    {
        // TODO: Implement popCriteria() method.
    }

    /**
     * Get Collection of Criteria
     *
     * @return Collection
     */
    public function getCriteria()
    {
        // TODO: Implement getCriteria() method.
    }

    /**
     * Find data by Criteria
     *
     * @param CriteriaInterface $criteria
     *
     * @return mixed
     */
    public function getByCriteria(CriteriaInterface $criteria)
    {
        // TODO: Implement getByCriteria() method.
    }

    /**
     * Skip Criteria
     *
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        // TODO: Implement skipCriteria() method.
    }

    /**
     * Reset all Criterias
     *
     * @return $this
     */
    public function resetCriteria()
    {
        // TODO: Implement resetCriteria() method.
    }

    protected function applyCriteria()
    {
    }
}
