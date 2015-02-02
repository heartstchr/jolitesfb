<?php

class AdsPricingTableSeeder extends Seeder {

	public function run()
	{
        AdPricing::create([
            'name'  =>  'Ad Slot 1',
            'features'  =>  '<ul><li>Feature 1</li></ul>',
            'validity'  =>  30,
            'price'     =>  10
        ]);

        AdPricing::create([
            'name'  =>  'Ad Slot 2',
            'features'  =>  '<ul><li>Feature 1</li></ul>',
            'validity'  =>  30,
            'price'     =>  10
        ]);

        AdPricing::create([
            'name'  =>  'Ad Slot 3',
            'features'  =>  '<ul><li>Feature 1</li></ul>',
            'validity'  =>  30,
            'price'     =>  10
        ]);

        AdPricing::create([
            'name'  =>  'Ad Slot 4',
            'features'  =>  '<ul><li>Feature 1</li></ul>',
            'validity'  =>  30,
            'price'     =>  10
        ]);
	}

}