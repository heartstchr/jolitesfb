<?php

namespace Facebook\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Facebook\Repositories\AlbumRepositoryInterface','Facebook\Repositories\Eloquent\AlbumRepository');

    }


} 