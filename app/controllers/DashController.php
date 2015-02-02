<?php

use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;

class DashController extends \BaseController {


    /**
     * @var Facebook\Repositories\Eloquent\UserRepository
     */
    protected  $user;

    public function __construct(UserRepository $user,SiteSettingsRepository $siteSettings)
    {
        parent::__construct($siteSettings);
        $this->user = $user;
        $this->siteSettings = $siteSettings;
    }
}