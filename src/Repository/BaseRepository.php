<?php

namespace Max26292\LaravelLazyTools\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class ModelExtend
 * @package Max26292\LaravelLazyTools\Repository
 * @mixin Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
 
class ModelExtend extends Model{
    // just a empty class for IDE
}
/**
 *
 */
abstract class BaseRepository
{

    /**
     * @var ModelExtend
     */
    protected $model;

    /**
     *
     */
    abstract public function __construct();

    /**
     * @return mixed
     */
    abstract function init();


    /**
     * @param $col
     * @return \Illuminate\Support\Collection
     */
    public function getAll($col = ['*'])
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @param $col
     * @return Builder|mixed|null
     */
    public function find($id, $col = ['*'])
    {
        return $this->model->find($id) ?? null;
    }

    /**
     * @param $col
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listWithPaginate($col = ['*'], $perPage = 15)
    {
        return $this->model->paginate($perPage, $col);
    }

    /**
     * @param array $attributes
     * @return null | mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    /**
     * 
     * @param array $attributes 
     * @return int| float| mixed 
     */
    public function insertGetId(array $attributes)
    {
        return $this->model->insertGetId($attributes);
    }
    /**
     * @param array $attributes
     * @return bool
     */
    public function insert(array $attributes)
    {
        return $this->model->insert($attributes);
    }

    /**
     * @param array $condition
     * @param array $attributes
     * @return bool
     */
    public function update(array $condition, array $attributes)
    {
        return $this->model->updateOrInsert($condition, $attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return int
     */
    public function updateById($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * please dont use that function if use sofe delete on model for completely delete
     * @param $id
     * @param $isForce
     * @return int
     */
    public function delete($id, $isForce)
    {
        return $this->model->find($id)->delete();
    }

}
