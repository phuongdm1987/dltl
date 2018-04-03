<?php namespace Fsd\Core;

use Illuminate\Database\Eloquent\Model;
use Fsd\Core\Exceptions\EntityNotFoundException;

abstract class EloquentRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function getInstance(){
        return new $this->model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }

    public function getById($id, array $fields = array('*'))
    {
        return $this->model->find($id, $fields);
    }

    public function requireById($id)
    {
        $model = $this->getById($id);

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    public function getNew($attributes = array())
    {
        $model = $this->getInstance();

        foreach($attributes as $field => $value) {
            $model->$field = $value;
        }

        return $model;
    }


    public function save($model)
    {
        $model->save();
        return $model;
    }

    public function delete($model)
    {
        return $model->delete();
    }

    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        return $this->storeEloquentModel($model);
    }
}
