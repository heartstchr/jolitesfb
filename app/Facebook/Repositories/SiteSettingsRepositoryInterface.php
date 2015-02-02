<?php


namespace Facebook\Repositories;


interface SiteSettingsRepositoryInterface {

    /**
     * Get setting by option name
     *
     * @param string $option
     * @return \Illuminate\Database\Eloquent\Collection|\Site_setting
     */
    public function find($option);

    /**
     * Get all the settings
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Site_setting
     */
    public function findAll();

    /**
     *Get settings by option names
     *
     * @param $options
     * @return \Illuminate\Database\Eloquent\Collection|\Site_setting[]
     */
    public function findSettings($options);
} 