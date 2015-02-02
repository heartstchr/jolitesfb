<?php


namespace Facebook\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;

class AbstractRepository {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param array $attributes
     * @return static
     */
    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }
} 