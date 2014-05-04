<?php

class MotherTableSeeder extends Seeder {

  public function run()
  {
    DB::table('mothers')->delete();

    Mother::create(array(
      'id'           => 1,
      'phone_number' => '+819053045165',
      'password'     => '1234',
      'sex'          => 0,
      'birthday'     => '1979-01-31',
      'blood'        => 1,
      'rh'           => 0,
      'schedule'     => '2014-05-31',
    ));

    Mother::create(array(
      'id'           => 2,
      'phone_number' => '+817064492347',
      'password'     => '1234',
      'sex'          => 0,
      'birthday'     => '1979-01-31',
      'blood'        => 1,
      'rh'           => 0,
      'schedule'     => '2014-04-05',
    ));

  }
} 