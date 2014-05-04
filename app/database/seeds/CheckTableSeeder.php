<?php
class CheckTableSeeder extends Seeder {

  public function run()
  {
    DB::table('checks')->delete();

    $params = array(
      array(1, '2014-01-01', 40.00, 80, 36.5, 72),
      array(1, '2014-02-01', 42.15, 90, 37.2, 75),
      array(1, '2014-05-10', 45.80, 85, 38.3, 81),
      array(2, '2013-01-01', 40.00, 80, 36.5, 72),
      array(2, '2013-02-01', 42.15, 90, 37.2, 75),
      array(2, '2013-05-10', 45.80, 85, 38.3, 81),
      array(2, '2014-01-01', 50.00, 80, 36.5, 72),
      array(2, '2014-02-01', 52.15, 90, 37.2, 75),
      array(2, '2014-05-10', 55.80, 85, 38.3, 81),
    );

    foreach ($params as $param)
    {
      Check::create(array(
        'mother_id'         => $param[0],
        'date_of_visit'     => $param[1],
        'weight_in_kg'      => $param[2],
        'blood_pressur'     => $param[3],
        'temperature'       => $param[4],
        'height_of_abdomen' => $param[5],
      ));
    }
  }
}