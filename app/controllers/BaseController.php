<?php

use Facebook\Repositories\Eloquent\SiteSettingsRepository;

class BaseController extends Controller {

    protected $currentSiteSettings;
    protected $siteSettings;

    public function __construct(SiteSettingsRepository $siteSettings)
    {
        $this->siteSettings = $siteSettings;
        $currentSiteSettings = $this->siteSettings->findAll();

        $siteData = array();
        if (!$currentSiteSettings->isEmpty()) {
            foreach ($currentSiteSettings as $siteSetting) {
                $siteData[$siteSetting->option] = $siteSetting->value;
            }
        }
        $this->layoutData = array();
        $this->layoutData = array_merge($this->layoutData, $siteData);
    }

    /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
