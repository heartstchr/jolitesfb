<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $this->call('SiteSettingsTableSeeder');
		$this->call('AdsPricingTableSeeder');
		// $this->call('UserTableSeeder');
	}

}
