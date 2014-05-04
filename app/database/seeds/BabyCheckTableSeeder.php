<?php
class BabyCheckTableSeeder extends Seeder {

  public function run()
  {
    DB::table('baby_checks')->delete();

    $params = array(
      array(1, '2014-01-01', 3.00, 80, 32),
      array(1, '2014-02-01', 3.15, 90, 45),
      array(1, '2014-05-10', 4.80, 85, 51),
      array(2, '2013-01-01', 4.00, 80, 42),
      array(2, '2013-02-01', 3.15, 90, 45),
      array(2, '2013-05-10', 5.80, 85, 51),
      array(2, '2014-01-01', 5.00, 80, 62),
      array(2, '2014-02-01', 6.15, 90, 75),
      array(2, '2014-05-10', 6.80, 85, 81),
    );

    foreach ($params as $param)
    {
      BabyCheck::create(array(
        'baby_id'           => $param[0],
        'date_of_visit'     => $param[1],
        'weight_in_kg'      => $param[2],
        'temperature'       => $param[3],
        'height'            => $param[4],
      ));
    }
  }
}