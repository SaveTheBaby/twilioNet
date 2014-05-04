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

    $this->call('MotherTableSeeder');
    $this->call('CheckTableSeeder');
    $this->call('BabyTableSeeder');
    $this->call('BabyCheckTableSeeder');
    $this->call('VaccinationSeeder');
	}

}