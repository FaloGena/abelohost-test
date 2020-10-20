<?php


namespace App\Repositories;


abstract class BaseRepository
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
