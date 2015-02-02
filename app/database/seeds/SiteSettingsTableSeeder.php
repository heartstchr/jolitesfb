<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SiteSettingsTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();

        Site_setting::create([
            'option' => 'website_title',
            'value' => 'Jolites'
		]);

        Site_setting::create([
            'option' => 'website_name',
            'value' => 'Jolites'
        ]);
	}

}