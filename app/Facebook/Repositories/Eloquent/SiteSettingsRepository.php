<?php


namespace Facebook\Repositories\Eloquent;


use Facebook\Repositories\SiteSettingsRepositoryInterface;

class SiteSettingsRepository extends AbstractRepository implements SiteSettingsRepositoryInterface {

    protected $model;

    public function __construct(\Site_setting $model)
    {
        $this->model = $model;
    }
    
    public function find($option)
    {
        $value = $this->model->where('option', $option)->first();
        return $value;
    }

    public function findAll()
    {
        $value = $this->model->get();
        return $value;
    }

    public function findSettings($options)
    {
        $value = $this->model->whereIn('option', $option)->get();
        return $value;
    }


} 