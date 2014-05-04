<?php

class BabyTableSeeder extends Seeder {

  public function run()
  {
    DB::table('babies')->delete();

    Baby::create(array(
      'id'           => 1,
      'mother_id'    => 1,
      'sex'          => 0,
      'birthday'     => '2014-05-31',
      'blood'        => 1,
      'rh'           => 0,
    ));

    Baby::create(array(
      'id'           => 2,
      'mother_id'    => 2,
      'sex'          => 1,
      'birthday'     => '2014-04-05',
      'blood'        => 1,
      'rh'           => 0,
    ));
  }
} 