<?php


namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\RepositoryInterface;

abstract class RepositoryEloquent implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }


    abstract public function getModel();

    public function getAll()
    {
        return $this->model->all();
    }

    public function delete($object)
    {
        return $object->delete();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $object)
    {
        return $object->update($data);
    }

    public function getById($id)
    {
        return $this->model::findOrFail($id);
    }

    public function search($column, $keyword)
    {
        return $this->model::where($column, "LIKE", "%" . $keyword . "%")->orderBy('updated_at', 'desc')->paginate(6);
    }
}
